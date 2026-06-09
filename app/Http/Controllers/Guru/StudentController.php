<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Teacher;
use App\Models\AcademicYear;
use App\Models\AttendanceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();

        if (!$teacher) {
            return back()->with('error', 'Data guru tidak ditemukan.');
        }

        $classIds = collect()
            ->merge($teacher->classes()->pluck('id'))
            ->merge($teacher->subjects()->with('classes')->get()->flatMap(fn($s) => $s->classes->pluck('id')))
            ->unique()
            ->values()
            ->toArray();

        $query = Student::with('kelas')->whereIn('kelas_id', $classIds);

        if ($request->filled('class_id')) {
            $query->where('kelas_id', $request->class_id);
        }

        $students = $query->orderBy('nama')->get();
        $classes = ClassRoom::whereIn('id', $classIds)->get();
        return view('guru.students.index', compact('students', 'classes'));
    }

    public function show(Student $student)
    {
        $student->load('kelas', 'attendanceDetails.attendance');
        return view('guru.students.show', compact('student'));
    }

    public function showAttendanceTrend(Student $student)
    {
        $activeYear = AcademicYear::active()->first();

        if (!$activeYear) {
            return back()->with('error', 'Tahun ajaran aktif belum diset oleh admin.');
        }

        $attendanceData = AttendanceDetail::where('student_id', $student->id)
            ->whereHas('attendance', function ($query) use ($activeYear) {
                $query->where('academic_year_id', $activeYear->id);
            })
            ->orderBy('created_at') // Order by creation date of attendance detail
            ->get();

        $chartLabels = [];
        $chartDatasets = [
            'hadir' => [],
            'sakit' => [],
            'izin' => [],
            'alfa' => [],
            'terlambat' => [],
        ];

        // Aggregate data by date
        $dailyAttendance = $attendanceData->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->attendance->tanggal)->format('Y-m-d');
        });

        foreach ($dailyAttendance as $date => $details) {
            $chartLabels[] = \Carbon\Carbon::parse($date)->format('d M');

            $hadir = $details->where('status', 'hadir')->count();
            $sakit = $details->where('status', 'sakit')->count();
            $izin = $details->where('status', 'izin')->count();
            $alfa = $details->where('status', 'alfa')->count();
            $terlambat = $details->where('status', 'terlambat')->count();

            $chartDatasets['hadir'][] = $hadir;
            $chartDatasets['sakit'][] = $sakit;
            $chartDatasets['izin'][] = $izin;
            $chartDatasets['alfa'][] = $alfa;
            $chartDatasets['terlambat'][] = $terlambat;
        }

        return view('guru.students.attendance_trend', compact('student', 'chartLabels', 'chartDatasets', 'activeYear'));
    }
}
