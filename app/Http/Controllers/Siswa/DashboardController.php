<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', Auth::id())
            ->with(['kelas', 'attendanceDetails.attendance'])
            ->first();
        return view('siswa.dashboard', compact('student'));
    }

    public function absensi()
    {
        $student = Student::where('user_id', Auth::id())
            ->with(['attendanceDetails.attendance'])
            ->first();
        return view('siswa.absensi', compact('student'));
    }
}
