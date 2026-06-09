<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Row;

class ExportController extends Controller
{
    public function exportAttendance(Request $request)
    {
        $activeYear = AcademicYear::active()->first();
        if (!$activeYear) {
            return back()->with('error', 'Tahun ajaran aktif belum diset.');
        }

        $query = Attendance::with(['kelas', 'guru', 'details.student'])
            ->where('academic_year_id', $activeYear->id)
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

        $writer = new Writer();
        $filename = 'rekap-absensi-' . now()->format('Y-m-d') . '.xlsx';
        $filePath = storage_path('app/public/' . $filename);

        $writer->openToFile($filePath);

        $headerRow = Row::fromValues(['Tanggal', 'Kelas', 'Guru', 'NIS', 'Nama Siswa', 'Status', 'Keterangan']);
        $writer->addRow($headerRow);

        foreach ($attendances as $attendance) {
            foreach ($attendance->details as $detail) {
                $row = Row::fromValues([
                    $attendance->tanggal,
                    $attendance->kelas->nama_kelas,
                    $attendance->guru->nama,
                    $detail->student->nis,
                    $detail->student->nama,
                    $detail->status,
                    $detail->keterangan ?? '-',
                ]);
                $writer->addRow($row);
            }
        }

        $writer->close();

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportStudentReport(Request $request)
    {
        $activeYear = AcademicYear::active()->first();
        if (!$activeYear) {
            return back()->with('error', 'Tahun ajaran aktif belum diset.');
        }

        $students = Student::with(['kelas', 'attendanceDetails' => function($q) use ($activeYear) {
            $q->whereHas('attendance', fn($sq) => $sq->where('academic_year_id', $activeYear->id));
        }])->orderBy('nama')->get();

        $writer = new Writer();
        $filename = 'laporan-siswa-' . now()->format('Y-m-d') . '.xlsx';
        $filePath = storage_path('app/public/' . $filename);

        $writer->openToFile($filePath);

        $headerRow = Row::fromValues(['NIS', 'Nama', 'Kelas', 'Total Hadir', 'Sakit', 'Izin', 'Alfa', 'Terlambat']);
        $writer->addRow($headerRow);

        foreach ($students as $student) {
            $hadir = $student->attendanceDetails->where('status', 'hadir')->count();
            $sakit = $student->attendanceDetails->where('status', 'sakit')->count();
            $izin = $student->attendanceDetails->where('status', 'izin')->count();
            $alfa = $student->attendanceDetails->where('status', 'alfa')->count();
            $terlambat = $student->attendanceDetails->where('status', 'terlambat')->count();

            $row = Row::fromValues([
                $student->nis,
                $student->nama,
                $student->kelas?->nama_kelas ?? '-',
                $hadir, $sakit, $izin, $alfa, $terlambat,
            ]);
            $writer->addRow($row);
        }

        $writer->close();

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
