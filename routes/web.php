<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru;
use App\Http\Controllers\Siswa;
use App\Http\Controllers\Admin;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LandingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/kehadiran-hari-ini', [LandingController::class, 'kehadiranHariIni']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'guru') {
            return redirect()->route('guru.dashboard');
        }
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('siswa.dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

    // Guru
    Route::prefix('guru')->name('guru.')->middleware('role:guru')->group(function () {
        Route::get('/dashboard', [Guru\DashboardController::class, 'index'])->name('dashboard');
        Route::get('students', [Guru\StudentController::class, 'index'])->name('students.index');
        Route::get('students/{student}', [Guru\StudentController::class, 'show'])->name('students.show');
        Route::get('students/{student}/attendance-trend', [Guru\StudentController::class, 'showAttendanceTrend'])->name('students.attendance-trend');
        Route::resource('attendances', Guru\AttendanceController::class);
        Route::get('attendances/{attendance}/pdf', [Guru\AttendanceController::class, 'exportPdf'])->name('attendances.pdf');
        Route::get('attendances-rekap/pdf', [Guru\AttendanceController::class, 'rekapPdf'])->name('attendances.rekap.pdf');
        Route::get('classes', [Guru\ClassController::class, 'index'])->name('classes.index');
        Route::get('classes/{class}', [Guru\ClassController::class, 'show'])->name('classes.show');

        // QR Attendance
        Route::get('qr-attendances', [Guru\QrAttendanceController::class, 'index'])->name('qr-attendances.index');
        Route::get('qr-attendances/create', [Guru\QrAttendanceController::class, 'create'])->name('qr-attendances.create');
        Route::post('qr-attendances', [Guru\QrAttendanceController::class, 'store'])->name('qr-attendances.store');
        Route::get('qr-attendances/{attendance}', [Guru\QrAttendanceController::class, 'show'])->name('qr-attendances.show');
        Route::delete('qr-attendances/{attendance}', [Guru\QrAttendanceController::class, 'destroy'])->name('qr-attendances.destroy');
    });

    // Siswa
    Route::prefix('siswa')->name('siswa.')->middleware('role:siswa')->group(function () {
        Route::get('/dashboard', [Siswa\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/absensi', [Siswa\DashboardController::class, 'absensi'])->name('absensi');
    });

    // Admin
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', Admin\UserController::class);
        
        // Student Import (must be before resource route)
        Route::get('students/import', [Admin\StudentImportController::class, 'index'])->name('students.import');
        Route::post('students/import', [Admin\StudentImportController::class, 'store'])->name('students.import.store');
        
        Route::resource('students', Admin\StudentController::class);
        Route::get('teachers', [Admin\TeacherController::class, 'index'])->name('teachers.index');
        Route::get('teachers/import', [Admin\TeacherImportController::class, 'index'])->name('teachers.import');
        Route::post('teachers/import', [Admin\TeacherImportController::class, 'store'])->name('teachers.import.store');
        Route::resource('classes', Admin\ClassController::class);
        Route::post('classes/{class}/students', [Admin\ClassController::class, 'addStudent'])->name('classes.addStudent');
        Route::delete('classes/{class}/students/{student}', [Admin\ClassController::class, 'removeStudent'])->name('classes.removeStudent');

        // Academic Year
        Route::get('academic-years', [Admin\AcademicYearController::class, 'index'])->name('academic-years.index');
        Route::post('academic-years', [Admin\AcademicYearController::class, 'store'])->name('academic-years.store');
        Route::post('academic-years/{academicYear}/activate', [Admin\AcademicYearController::class, 'activate'])->name('academic-years.activate');
        Route::delete('academic-years/{academicYear}', [Admin\AcademicYearController::class, 'destroy'])->name('academic-years.destroy');

        // Attendance Admin
        Route::get('attendances', [Admin\AttendanceController::class, 'index'])->name('attendances.index');
        Route::get('attendances/rekap', [Admin\AttendanceController::class, 'rekap'])->name('attendances.rekap');
        Route::get('attendances/{attendance}', [Admin\AttendanceController::class, 'show'])->name('attendances.show');
        Route::get('attendances-export', [Admin\AttendanceController::class, 'exportPdf'])->name('attendances.export');

        // Subjects
        Route::resource('subjects', Admin\SubjectController::class);

        // Settings
        Route::get('settings', [Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::post('settings', [Admin\SettingsController::class, 'update'])->name('settings.update');

        // Export Excel
        Route::get('export/attendance', [Admin\ExportController::class, 'exportAttendance'])->name('export.attendance');
        Route::get('export/student-report', [Admin\ExportController::class, 'exportStudentReport'])->name('export.student-report');

        // Laporan PDF
        Route::get('laporan', [Admin\LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/siswa-pdf', [Admin\LaporanController::class, 'siswaPdf'])->name('laporan.siswa-pdf');
        Route::get('laporan/kelas-pdf', [Admin\LaporanController::class, 'kelasPdf'])->name('laporan.kelas-pdf');

        // Audit Logs
        Route::get('audit-logs', [Admin\AuditLogController::class, 'index'])->name('audit-logs.index');

        // Admin Feedback Management
        Route::get('feedback', [Admin\FeedbackController::class, 'index'])->name('feedback.index');
        Route::get('feedback/{feedback}', [Admin\FeedbackController::class, 'show'])->name('feedback.show');
        Route::post('feedback/{feedback}', [Admin\FeedbackController::class, 'update'])->name('feedback.update');
        Route::delete('feedback/{feedback}', [Admin\FeedbackController::class, 'destroy'])->name('feedback.destroy');
    });

    // Feedback (all authenticated users)
    Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});

// QR Scan - public (no auth required)
Route::get('scan-qr/{token}', [Guru\QrAttendanceController::class, 'scanPage'])->name('guru.qr-attendances.scan-page');
Route::post('scan-qr/{token}', [Guru\QrAttendanceController::class, 'scanStudent'])->name('guru.qr-attendances.scan-student')->middleware('throttle:10,1');

Route::get('/design-preview', function () {
    return view('design-preview');
})->name('design-preview');

require __DIR__.'/auth.php';
