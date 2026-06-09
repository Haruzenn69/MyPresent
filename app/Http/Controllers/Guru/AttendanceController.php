<?php

namespace App\Http\Controllers\Guru;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\ClassRoom;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAttendanceRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AttendanceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:viewAny,App\Models\Attendance', only: ['index', 'rekapPdf']),
            new Middleware('can:view,attendance', only: ['show', 'exportPdf']),
            new Middleware('can:create,App\Models\Attendance', only: ['create', 'store']),
            new Middleware('can:update,attendance', only: ['edit', 'update']),
            new Middleware('can:delete,attendance', only: ['destroy']),
        ];
    }

    public function index(Request $request)
	{
    	$query = Attendance::with(['kelas', 'guru', 'details'])
        	->orderByDesc('tanggal');

        if (Auth::user()->role === 'guru') {
            $teacher = Teacher::where('user_id', Auth::id())->first();
            if ($teacher) {
                $query->where('teacher_id', $teacher->id);
            }
        }

    	if ($request->filled('class_id')) {
        	$query->where('class_id', $request->class_id);
    	}

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

    	$attendances = $query->paginate(15)->withQueryString();
    	$classes = ClassRoom::all();

    	return view('guru.attendances.index', compact('attendances', 'classes'));
	}

    public function create()
    {
        $classes = ClassRoom::with('students')->get();
        $today = now()->toDateString();
        $attendedToday = AttendanceDetail::whereHas('attendance', function ($q) use ($today) {
            $q->whereDate('tanggal', $today);
        })->pluck('student_id')->toArray();
        return view('guru.attendances.create', compact('classes', 'attendedToday'));
    }

    public function store(StoreAttendanceRequest $request)
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();
        if (!$teacher) {
            return back()->withErrors(['teacher' => 'Data guru tidak ditemukan. Hubungi admin.']);
        }

        $activeYear = \App\Models\AcademicYear::active()->first();
        if (!$activeYear) {
            return back()->withErrors(['academic_year' => 'Tahun ajaran aktif belum diset oleh admin.']);
        }

        $attendance = Attendance::where('class_id', $request->class_id)
            ->where('tanggal', $request->tanggal)
            ->first();

        if (!$attendance) {
            $attendance = Attendance::create([
                'class_id'   => $request->class_id,
                'teacher_id' => $teacher->id,
                'tanggal'    => $request->tanggal,
                'academic_year_id' => $activeYear->id,
            ]);
        }

        $validStudentIds = \App\Models\Student::where('kelas_id', $request->class_id)
            ->pluck('id')
            ->toArray();

        foreach ($request->absensi as $student_id => $data) {
            if (!in_array((int)$student_id, $validStudentIds)) {
                continue;
            }

            AttendanceDetail::updateOrCreate(
                ['attendance_id' => $attendance->id, 'student_id' => (int)$student_id],
                ['status' => $data['status'], 'keterangan' => $data['keterangan'] ?? null]
            );
        }

        if ($attendance->qr_code_token) {
            $total = count($validStudentIds);
            $marked = AttendanceDetail::where('attendance_id', $attendance->id)->count();
            if ($marked >= $total && $total > 0) {
                $attendance->update(['qr_expires_at' => now()->subSecond()]);
            }
        }

        return redirect()->route('guru.attendances.index')
            ->with('success', 'Absensi berhasil disimpan!');
    }

    public function show(Attendance $attendance)
    {
        $attendance->load('kelas', 'guru', 'details.student');
        return view('guru.attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $attendance->load('kelas', 'details.student');
        return view('guru.attendances.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'absensi' => 'required|array',
            'absensi.*.status' => 'required|in:hadir,sakit,izin,alfa,terlambat',
        ]);

        foreach ($request->absensi as $detail_id => $data) {
            AttendanceDetail::where('id', $detail_id)->update([
                'status'     => $data['status'],
                'keterangan' => $data['keterangan'] ?? null,
            ]);
        }

        return redirect()->route('guru.attendances.show', $attendance)
            ->with('success', 'Absensi berhasil diperbarui!');
    }

    public function destroy(Attendance $attendance)
	{
    	// Hanya boleh hapus absensi hari ini
    	if ($attendance->tanggal !== now()->toDateString()) {
        	return redirect()->route('guru.attendances.index')
            	->with('error', 'Absensi hanya bisa dihapus pada hari yang sama.');
    	}

    	$attendance->details()->delete();
    	$attendance->delete();

    	return redirect()->route('guru.attendances.index')
        	->with('success', 'Data absensi berhasil dihapus!');
	}

    public function exportPdf(Attendance $attendance)
    {
        $attendance->load('kelas', 'guru', 'details.student');
        $pdf = Pdf::loadView('guru.attendances.pdf', compact('attendance'));
        return $pdf->download('absensi-' . $attendance->tanggal . '.pdf');
    }

    public function rekapPdf(Request $request)
    {
        $query = Attendance::with('kelas', 'guru', 'details.student')
            ->orderByDesc('tanggal');

        if ($request->class_id) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $attendances = $query->get();
        $classes = ClassRoom::all();

        $pdf = Pdf::loadView('guru.attendances.rekap_pdf',
            compact('attendances', 'classes'));
        return $pdf->download('rekap-absensi.pdf');
    }
}
