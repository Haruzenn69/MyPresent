<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\Attendance;
use App\Models\AttendanceDetail;

class DashboardController extends Controller
{
    public function index()
	{
    	if (auth()->user()->role !== 'guru') {
        	abort(403);
    	}

        $teacher = Teacher::where('user_id', auth()->id())->first();
        if (!$teacher) {
            abort(404, 'Data guru tidak ditemukan');
        }
        
        $myClassStats = null;
        $myClass = null;
    
    	$totalAbsensi = Attendance::where('teacher_id', $teacher->id)->count();

        $today = now()->toDateString();
        $todayAttendances = Attendance::where('tanggal', $today)
            ->where('teacher_id', $teacher->id)
            ->withCount(['details as hadir_count' => fn($q) => $q->where('status', 'hadir')])
            ->get();
        $kehadiranHariIni = $todayAttendances->sum('hadir_count');

        $siswaDiabsen = AttendanceDetail::whereHas('attendance', fn($q) => $q->where('teacher_id', $teacher->id))
            ->distinct('student_id')->count('student_id');

    	// Cek apakah guru ini adalah Wali Kelas
    	$myClass = ClassRoom::where('wali_kelas', $teacher->id)->first();

    	if ($myClass) {
    	    $myClass->loadCount('students');
    	    $today = now()->toDateString();
    	    $myClassAttendance = Attendance::where('class_id', $myClass->id)
    	        ->where('tanggal', $today)
    	        ->withCount([
    	            'details as hadir_count' => fn($q) => $q->where('status', 'hadir'),
    	            'details as izin_count' => fn($q) => $q->where('status', 'izin'),
    	            'details as sakit_count' => fn($q) => $q->where('status', 'sakit'),
    	            'details as alfa_count' => fn($q) => $q->where('status', 'alfa'),
    	            'details as terlambat_count' => fn($q) => $q->where('status', 'terlambat'),
    	        ])->first();

    	    $myClassStats = (object)[
    	        'nama_kelas' => $myClass->nama_kelas,
    	        'total_siswa' => $myClass->students_count,
    	        'hadir_count' => $myClassAttendance?->hadir_count ?? 0,
    	        'izin_count' => $myClassAttendance?->izin_count ?? 0,
    	        'sakit_count' => $myClassAttendance?->sakit_count ?? 0,
    	        'alfa_count' => $myClassAttendance?->alfa_count ?? 0,
    	        'terlambat_count' => $myClassAttendance?->terlambat_count ?? 0,
    	    ];
    	}

    	// Statistik Hari Ini
    	$today = now()->toDateString();        $todayAttendance = Attendance::where('tanggal', $today)
            ->where('teacher_id', $teacher->id)
            ->withCount([
                'details as hadir_count' => fn($q) => $q->where('status', 'hadir'),
                'details as izin_count' => fn($q) => $q->where('status', 'izin'),
                'details as sakit_count' => fn($q) => $q->where('status', 'sakit'),
                'details as alfa_count' => fn($q) => $q->where('status', 'alfa'),
                'details as terlambat_count' => fn($q) => $q->where('status', 'terlambat'),
            ])->first();

        // Data Grafik (7 Hari Terakhir) - Optimized Query
        $startDate = now()->subDays(6)->toDateString();
        $counts = AttendanceDetail::whereHas('attendance', function($q) use ($startDate, $teacher) {
            $q->where('tanggal', '>=', $startDate)->where('teacher_id', $teacher->id);
        })
        ->where('status', 'hadir')
        ->join('attendances', 'attendance_details.attendance_id', '=', 'attendances.id')
        ->selectRaw('attendances.tanggal, count(*) as total')
        ->groupBy('attendances.tanggal')
        ->pluck('total', 'tanggal');

        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $dayName = now()->subDays($i)->isoFormat('dddd');
            $chartData['labels'][] = $dayName;
            $chartData['values'][] = $counts[$date] ?? 0;
        }

        // Peringatan: Siswa di kelas guru ini yang Alfa >= 3
        $warningStudents = Student::whereHas('kelas', function($q) use ($teacher) {
            // Asumsi: Guru bisa melihat peringatan untuk kelas yang pernah mereka absensi
            // Atau jika ada relasi khusus wali kelas, tapi di sini kita pakai data absensi yang pernah dibuat guru ini
            $q->whereHas('attendances', function($sq) use ($teacher) {
                $sq->where('teacher_id', $teacher->id);
            });
        })
        ->withCount(['attendanceDetails as alfa_count' => function($q) {
            $q->where('status', 'alfa');
        }])
        ->having('alfa_count', '>=', 3)
        ->orderByDesc('alfa_count')
        ->get();

        $peringatanCount = $warningStudents->count();

    	return view('guru.dashboard', compact(
        	'totalAbsensi', 'kehadiranHariIni', 'siswaDiabsen', 'peringatanCount',
            'todayAttendance', 'chartData', 'warningStudents', 'myClassStats'
    	));
	}
}
