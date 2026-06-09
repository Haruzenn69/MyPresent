<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $activeYear = AcademicYear::active()->first();
        if (!$activeYear) {
            return back()->with('error', 'Tahun ajaran aktif belum diset oleh admin.');
        }

        $query = Attendance::with(['kelas', 'guru'])
            ->where('academic_year_id', $activeYear->id) // Filter by active academic year
            ->withCount([
                'details as total_hadir' => function ($query) {
                    $query->where('status', 'hadir');
                },
                'details as total_izin' => function ($query) {
                    $query->where('status', 'izin');
                },
                'details as total_sakit' => function ($query) {
                    $query->where('status', 'sakit');
                },
                'details as total_alfa' => function ($query) {
                    $query->where('status', 'alfa');
                },
                'details as total_terlambat' => function ($query) {
                    $query->where('status', 'terlambat');
                },
            ])
            ->orderByDesc('tanggal');

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $attendances = $query->paginate(10)->withQueryString();
        $classes = ClassRoom::orderBy('nama_kelas')->get();

        return view('admin.attendances.index', compact('attendances', 'classes'));
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['kelas', 'guru', 'details.student']);

        if ($attendance->qr_code_token && (!$attendance->qr_expires_at || now()->lessThan($attendance->qr_expires_at))) {
            $total = Student::where('kelas_id', $attendance->class_id)->count();
            $marked = AttendanceDetail::where('attendance_id', $attendance->id)->count();
            if ($marked >= $total && $total > 0) {
                $attendance->update(['qr_expires_at' => now()->subSecond()]);
            }
        }

        return view('admin.attendances.show', compact('attendance'));
    }

    public function rekap(Request $request)
    {
        $activeYear = AcademicYear::active()->first();
        if (!$activeYear) {
            return back()->with('error', 'Tahun ajaran aktif belum diset oleh admin.');
        }

        $classes = ClassRoom::withCount('students')->get();
        
        $summary = [];
        
        foreach ($classes as $class) {
            $detailsQuery = AttendanceDetail::whereHas('attendance', function($q) use ($class, $request, $activeYear) {
                $q->where('class_id', $class->id)
                    ->where('academic_year_id', $activeYear->id); // Filter by active academic year
                if ($request->filled('start_date')) {
                    $q->whereDate('tanggal', '>=', $request->start_date);
                }
                if ($request->filled('end_date')) {
                    $q->whereDate('tanggal', '<=', $request->end_date);
                }
            });

            $summary[] = [
                'kelas' => $class->nama_kelas,
                'total_siswa' => $class->students_count,
                'hadir' => (clone $detailsQuery)->where('status', 'hadir')->count(),
                'izin' => (clone $detailsQuery)->where('status', 'izin')->count(),
                'sakit' => (clone $detailsQuery)->where('status', 'sakit')->count(),
                'alfa' => (clone $detailsQuery)->where('status', 'alfa')->count(),
                'terlambat' => (clone $detailsQuery)->where('status', 'terlambat')->count(),
            ];
        }

        return view('admin.attendances.rekap', compact('summary', 'classes'));
    }

    public function exportPdf(Request $request)
    {
        $activeYear = AcademicYear::active()->first();
        if (!$activeYear) {
            return back()->with('error', 'Tahun ajaran aktif belum diset oleh admin.');
        }

        $query = Attendance::with(['kelas', 'guru', 'details.student'])
            ->where('academic_year_id', $activeYear->id) // Filter by active academic year
            ->orderByDesc('tanggal');

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $attendances = $query->get();
        
        $pdf = Pdf::loadView('admin.attendances.pdf_rekap', compact('attendances'));
        return $pdf->download('rekap-absensi-admin.pdf');
    }
}
