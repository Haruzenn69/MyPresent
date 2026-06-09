<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'kelas'])->orderBy('nama')->paginate(20);
        return response()->json($students);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:students,nis',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'kelas_id' => 'nullable|exists:classes,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);

        return response()->json($student->load('user', 'kelas'), 201);
    }

    public function show(Student $student)
    {
        $student->load(['user', 'kelas', 'attendanceDetails.attendance']);
        return response()->json($student);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nis' => 'required|string|unique:students,nis,' . $student->id,
            'nama' => 'required|string|max:255',
            'kelas_id' => 'nullable|exists:classes,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
        ]);

        $student->update($request->only('nis', 'nama', 'kelas_id', 'jenis_kelamin', 'alamat'));
        $student->user->update(['name' => $request->nama]);

        return response()->json($student->load('user', 'kelas'));
    }

    public function destroy(Student $student)
    {
        $student->attendanceDetails()->delete();
        $student->user->delete();
        $student->delete();
        return response()->json(['message' => 'Siswa berhasil dihapus.']);
    }
}
