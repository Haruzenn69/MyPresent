<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\AcademicYear;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Auth;

class QrAttendanceController extends Controller
{
    public function index()
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();
        $attendances = Attendance::where('teacher_id', $teacher->id)
            ->whereNotNull('qr_code_token')
            ->with('kelas')
            ->orderByDesc('tanggal')
            ->get();
        return view('guru.qr_attendances.index', compact('attendances'));
    }

    public function create()
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();
        $classes = \App\Models\ClassRoom::where('wali_kelas', $teacher->id)
            ->orWhereHas('attendances', fn($q) => $q->where('teacher_id', $teacher->id))
            ->get();
        return view('guru.qr_attendances.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'tanggal' => 'required|date',
            'expires_in' => 'nullable|integer|min:1|max:720',
        ]);

        $exists = Attendance::where('class_id', $request->class_id)
            ->where('tanggal', $request->tanggal)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Absensi sudah ada untuk kelas dan tanggal ini.');
        }

        $teacher = Teacher::where('user_id', Auth::id())->first();
        $activeYear = AcademicYear::active()->first();

        $token = Str::random(32);
        $expiryMinutes = $request->expires_in ?: (Setting::getValue('qr_expiry_minutes', 120));
        $expiresAt = now()->addMinutes((int)$expiryMinutes);

        $attendance = Attendance::create([
            'class_id' => $request->class_id,
            'teacher_id' => $teacher->id,
            'tanggal' => $request->tanggal,
            'academic_year_id' => $activeYear?->id,
            'qr_code_token' => $token,
            'qr_code_path' => route('guru.qr-attendances.scan-page', $token),
            'qr_expires_at' => $expiresAt,
        ]);

        return redirect()->route('guru.qr-attendances.show', $attendance)
            ->with('success', 'QR Code absensi berhasil dibuat!');
    }

    public function show(Attendance $attendance)
    {
        $attendance->load('kelas', 'details.student');
        $this->autoExpireIfComplete($attendance);
        $qrCode = new QRCode;
        $qrData = $qrCode->render($attendance->qr_code_path);
        return view('guru.qr_attendances.show', compact('attendance', 'qrData'));
    }

    public function scanPage($token)
    {
        $attendance = Attendance::where('qr_code_token', $token)->with('kelas')->firstOrFail();
        $this->autoExpireIfComplete($attendance);
        $expired = $attendance->qr_expires_at && now()->greaterThanOrEqualTo($attendance->qr_expires_at);
        return view('guru.qr_attendances.scan', compact('attendance', 'expired'));
    }

    public function scanStudent(Request $request, $token)
    {
        $request->validate([
            'student_nis' => 'required|string|exists:students,nis',
        ]);

        $attendance = Attendance::where('qr_code_token', $token)->firstOrFail();

        if ($attendance->qr_expires_at && now()->greaterThanOrEqualTo($attendance->qr_expires_at)) {
            return response()->json(['success' => false, 'message' => 'QR Code sudah kedaluwarsa.'], 410);
        }
        $student = Student::where('nis', $request->student_nis)->firstOrFail();

        if ($student->kelas_id !== $attendance->class_id) {
            return response()->json(['success' => false, 'message' => 'Siswa tidak terdaftar di kelas ini.'], 422);
        }

        $exists = AttendanceDetail::where('attendance_id', $attendance->id)
            ->where('student_id', $student->id)
            ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Siswa sudah terdaftar.'], 422);
        }

        AttendanceDetail::create([
            'attendance_id' => $attendance->id,
            'student_id' => $student->id,
            'status' => 'hadir',
        ]);

        $totalStudents = \App\Models\Student::where('kelas_id', $attendance->class_id)->count();
        $scannedStudents = AttendanceDetail::where('attendance_id', $attendance->id)->count();

        if ($scannedStudents >= $totalStudents) {
            $attendance->update(['qr_expires_at' => now()->subSecond()]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil!',
            'student' => ['nama' => $student->nama, 'nis' => $student->nis]
        ]);
    }

    private function autoExpireIfComplete(Attendance $attendance): void
    {
        $stillActive = !$attendance->qr_expires_at || now()->lessThan($attendance->qr_expires_at);
        if (!$stillActive) {
            return;
        }

        $totalStudents = Student::where('kelas_id', $attendance->class_id)->count();
        $scannedStudents = AttendanceDetail::where('attendance_id', $attendance->id)->count();

        if ($scannedStudents >= $totalStudents && $totalStudents > 0) {
            $attendance->update(['qr_expires_at' => now()->subSecond()]);
        }
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->details()->delete();
        $attendance->delete();
        return redirect()->route('guru.qr-attendances.index')
            ->with('success', 'QR Attendance berhasil dihapus.');
    }
}
