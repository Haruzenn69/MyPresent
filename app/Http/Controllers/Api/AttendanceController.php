<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['kelas', 'guru', 'subject', 'details'])
            ->orderByDesc('tanggal');

        if (Auth::user()->role === 'guru') {
            $teacher = Teacher::where('user_id', Auth::id())->first();
            if ($teacher) {
                $query->where('teacher_id', $teacher->id);
            }
        }

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        return response()->json($query->paginate(20));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'tanggal' => 'required|date',
            'subject_id' => 'nullable|exists:subjects,id',
            'absensi' => 'required|array',
            'absensi.*.student_id' => 'required|exists:students,id',
            'absensi.*.status' => 'required|in:hadir,sakit,izin,alfa,terlambat',
        ]);

        $exists = Attendance::where('class_id', $request->class_id)
            ->where('tanggal', $request->tanggal)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Absensi sudah ada untuk kelas, tanggal, dan sesi ini.'], 422);
        }

        $teacher = Teacher::where('user_id', Auth::id())->first();
        if (!$teacher) {
            return response()->json(['message' => 'Data guru tidak ditemukan.'], 404);
        }

        $activeYear = AcademicYear::active()->first();
        if (!$activeYear) {
            return response()->json(['message' => 'Tahun ajaran aktif belum diset.'], 422);
        }

        $attendance = Attendance::create([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $teacher->id,
            'tanggal' => $request->tanggal,
            'academic_year_id' => $activeYear->id,
        ]);

        foreach ($request->absensi as $data) {
            AttendanceDetail::create([
                'attendance_id' => $attendance->id,
                'student_id' => $data['student_id'],
                'status' => $data['status'],
                'keterangan' => $data['keterangan'] ?? null,
            ]);
        }

        if ($attendance->qr_code_token) {
            $total = \App\Models\Student::where('kelas_id', $attendance->class_id)->count();
            $marked = AttendanceDetail::where('attendance_id', $attendance->id)->count();
            if ($marked >= $total && $total > 0) {
                $attendance->update(['qr_expires_at' => now()->subSecond()]);
            }
        }

        return response()->json($attendance->load('details'), 201);
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['kelas', 'guru', 'subject', 'details.student']);
        $this->autoExpireIfComplete($attendance);
        return response()->json($attendance->fresh());
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'absensi' => 'required|array',
            'absensi.*.id' => 'required|exists:attendance_details,id',
            'absensi.*.status' => 'required|in:hadir,sakit,izin,alfa,terlambat',
        ]);

        foreach ($request->absensi as $data) {
            AttendanceDetail::where('id', $data['id'])->update([
                'status' => $data['status'],
                'keterangan' => $data['keterangan'] ?? null,
            ]);
        }

        return response()->json(['message' => 'Absensi berhasil diperbarui.']);
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->details()->delete();
        $attendance->delete();
        return response()->json(['message' => 'Absensi berhasil dihapus.']);
    }

    public function siswaAttendance()
    {
        $student = Student::where('user_id', Auth::id())->first();
        if (!$student) {
            return response()->json(['message' => 'Data siswa tidak ditemukan.'], 404);
        }

        $details = AttendanceDetail::where('student_id', $student->id)
            ->with('attendance.kelas')
            ->orderByDesc('created_at')
            ->get();

        return response()->json($details);
    }

    public function siswaRekap()
    {
        $student = Student::where('user_id', Auth::id())->first();
        if (!$student) {
            return response()->json(['message' => 'Data siswa tidak ditemukan.'], 404);
        }

        $stats = [
            'total' => AttendanceDetail::where('student_id', $student->id)->count(),
            'hadir' => AttendanceDetail::where('student_id', $student->id)->where('status', 'hadir')->count(),
            'sakit' => AttendanceDetail::where('student_id', $student->id)->where('status', 'sakit')->count(),
            'izin' => AttendanceDetail::where('student_id', $student->id)->where('status', 'izin')->count(),
            'alfa' => AttendanceDetail::where('student_id', $student->id)->where('status', 'alfa')->count(),
            'terlambat' => AttendanceDetail::where('student_id', $student->id)->where('status', 'terlambat')->count(),
        ];

        return response()->json($stats);
    }

    public function generateQr(Attendance $attendance)
    {
        $token = Str::random(32);
        $attendance->update([
            'qr_code_token' => $token,
            'qr_code_path' => url('/api/scan-qr/' . $token),
        ]);

        $qrCode = \chillerlan\QRCode\QRCode::render($attendance->qr_code_path);

        return response()->json([
            'attendance' => $attendance,
            'qr_code' => base64_encode($qrCode),
            'qr_url' => $attendance->qr_code_path,
        ]);
    }

    public function scanQr(Request $request)
    {
        $request->validate([
            'qr_token' => 'required|string',
            'student_id' => 'required|exists:students,id',
        ]);

        $attendance = Attendance::where('qr_code_token', $request->qr_token)->first();
        if (!$attendance) {
            return response()->json(['message' => 'QR Code tidak valid.'], 404);
        }

        if ($attendance->qr_expires_at && now()->greaterThanOrEqualTo($attendance->qr_expires_at)) {
            return response()->json(['message' => 'QR Code sudah kedaluwarsa.'], 410);
        }

        $student = \App\Models\Student::find($request->student_id);
        if (!$student || $student->kelas_id !== $attendance->class_id) {
            return response()->json(['message' => 'Siswa tidak terdaftar di kelas ini.'], 422);
        }

        $exists = AttendanceDetail::where('attendance_id', $attendance->id)
            ->where('student_id', $request->student_id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Siswa sudah terdaftar dalam absensi ini.'], 422);
        }

        $detail = AttendanceDetail::create([
            'attendance_id' => $attendance->id,
            'student_id' => $request->student_id,
            'status' => 'hadir',
        ]);

        $totalStudents = \App\Models\Student::where('kelas_id', $attendance->class_id)->count();
        $scannedStudents = AttendanceDetail::where('attendance_id', $attendance->id)->count();

        if ($scannedStudents >= $totalStudents && $totalStudents > 0) {
            $attendance->update(['qr_expires_at' => now()->subSecond()]);
        }

        return response()->json($detail, 201);
    }

    private function autoExpireIfComplete(Attendance $attendance): void
    {
        $stillActive = !$attendance->qr_expires_at || now()->lessThan($attendance->qr_expires_at);
        if (!$stillActive) {
            return;
        }

        $total = \App\Models\Student::where('kelas_id', $attendance->class_id)->count();
        $marked = AttendanceDetail::where('attendance_id', $attendance->id)->count();

        if ($marked >= $total && $total > 0) {
            $attendance->update(['qr_expires_at' => now()->subSecond()]);
        }
    }
}
