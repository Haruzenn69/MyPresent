<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
use App\Models\AttendanceDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::orderBy('nama_kelas')->get();
        return view('admin.laporan.index', compact('classes'));
    }

    public function siswaPdf(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $activeYear = AcademicYear::active()->first();
        $student = Student::with('kelas')->findOrFail($request->student_id);

        $query = AttendanceDetail::where('student_id', $student->id)
            ->with('attendance');

        if ($activeYear) {
            $query->whereHas('attendance', fn($q) => $q->where('academic_year_id', $activeYear->id));
        }
        if ($request->filled('start_date')) {
            $query->whereHas('attendance', fn($q) => $q->whereDate('tanggal', '>=', $request->start_date));
        }
        if ($request->filled('end_date')) {
            $query->whereHas('attendance', fn($q) => $q->whereDate('tanggal', '<=', $request->end_date));
        }

        $details = $query->get();

        $stats = [
            'hadir' => $details->where('status', 'hadir')->count(),
            'sakit' => $details->where('status', 'sakit')->count(),
            'izin' => $details->where('status', 'izin')->count(),
            'alfa' => $details->where('status', 'alfa')->count(),
            'terlambat' => $details->where('status', 'terlambat')->count(),
        ];

        $pdf = Pdf::loadView('admin.laporan.siswa_pdf', compact('student', 'details', 'stats', 'activeYear'));
        return $pdf->download('laporan-siswa-' . $student->nis . '.pdf');
    }

    public function kelasPdf(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $activeYear = AcademicYear::active()->first();
        $class = ClassRoom::with('students')->findOrFail($request->class_id);

        $rekap = [];
        foreach ($class->students as $student) {
            $query = AttendanceDetail::where('student_id', $student->id);
            
            if ($activeYear) {
                $query->whereHas('attendance', fn($q) => $q->where('academic_year_id', $activeYear->id));
            }
            if ($request->filled('start_date')) {
                $query->whereHas('attendance', fn($q) => $q->whereDate('tanggal', '>=', $request->start_date));
            }
            if ($request->filled('end_date')) {
                $query->whereHas('attendance', fn($q) => $q->whereDate('tanggal', '<=', $request->end_date));
            }

            $details = $query->get();
            $rekap[] = [
                'nis' => $student->nis,
                'nama' => $student->nama,
                'hadir' => $details->where('status', 'hadir')->count(),
                'sakit' => $details->where('status', 'sakit')->count(),
                'izin' => $details->where('status', 'izin')->count(),
                'alfa' => $details->where('status', 'alfa')->count(),
                'terlambat' => $details->where('status', 'terlambat')->count(),
            ];
        }

        $pdf = Pdf::loadView('admin.laporan.kelas_pdf', compact('class', 'rekap', 'activeYear'));
        return $pdf->download('laporan-kelas-' . $class->nama_kelas . '.pdf');
    }
}
