<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Siswa
    Route::get('/siswa/absensi', [AttendanceController::class, 'siswaAttendance']);
    Route::get('/siswa/absensi/rekap', [AttendanceController::class, 'siswaRekap']);

    // Guru
    Route::middleware('role:guru,admin')->prefix('guru')->group(function () {
        Route::apiResource('attendances', AttendanceController::class);
        Route::get('attendances/{attendance}/qr', [AttendanceController::class, 'generateQr']);
        Route::post('attendances/scan-qr', [AttendanceController::class, 'scanQr'])->middleware('throttle:30,1');
    });

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::apiResource('students', StudentController::class);
        Route::apiResource('subjects', SubjectController::class);
    });
});
