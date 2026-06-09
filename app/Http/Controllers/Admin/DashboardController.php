<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;

use App\Models\AttendanceDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser   = User::count();
        $totalGuru   = Teacher::count();
        $totalSiswa  = Student::count();
        $totalKelas  = ClassRoom::count();
        $totalAbsensi = Attendance::count();

        $recentUsers = User::latest()->take(5)->get();

        // Statistik Hari Ini (Seluruh Sekolah) - optimized single query
        $today = now()->toDateString();
        $stats = AttendanceDetail::whereHas('attendance', fn($q) => $q->where('tanggal', $today))
            ->selectRaw("COUNT(*) as total")
            ->selectRaw("SUM(status = 'hadir') as hadir")
            ->selectRaw("SUM(status = 'izin') as izin")
            ->selectRaw("SUM(status = 'sakit') as sakit")
            ->selectRaw("SUM(status = 'alfa') as alfa")
            ->selectRaw("SUM(status = 'terlambat') as terlambat")
            ->first();

        $todayStats = [
            'hadir' => (int) ($stats->hadir ?? 0),
            'izin' => (int) ($stats->izin ?? 0),
            'sakit' => (int) ($stats->sakit ?? 0),
            'alfa' => (int) ($stats->alfa ?? 0),
            'terlambat' => (int) ($stats->terlambat ?? 0),
        ];

        // Data Grafik (7 Hari Terakhir - Seluruh Sekolah) - Optimized Query
        $startDate = now()->subDays(6)->toDateString();
        $counts = AttendanceDetail::whereHas('attendance', function($q) use ($startDate) {
            $q->where('tanggal', '>=', $startDate);
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

        // Siswa dengan Alfa > 3 kali (Peringatan)
        $warningStudents = Student::withCount(['attendanceDetails as alfa_count' => function($q) {
            $q->where('status', 'alfa');
        }])
        ->having('alfa_count', '>=', 3)
        ->orderByDesc('alfa_count')
        ->get();

        return view('admin.dashboard', compact(
            'totalUser', 'totalGuru', 'totalSiswa',
            'totalKelas', 'totalAbsensi', 'recentUsers',
            'todayStats', 'chartData', 'warningStudents'
        ));
    }
}
