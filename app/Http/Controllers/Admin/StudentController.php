<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'kelas'])
            ->orderBy('nama')
            ->paginate(15);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classes = ClassRoom::orderBy('nama_kelas')->get();
        return view('admin.students.create', compact('classes'));
    }

    public function store(StoreStudentRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'siswa',
        ]);

        Student::create([
            'user_id' => $user->id,
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'kelas_id' => $validated['kelas_id'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'alamat' => $validated['alamat'] ?? null,
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function show(Student $student)
    {
        $student->load(['user', 'kelas', 'attendanceDetails.attendance']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classes = ClassRoom::orderBy('nama_kelas')->get();
        $student->load(['user', 'kelas']);
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validated = $request->validated();

        $student->user->update([
            'name' => $validated['nama'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('password')) {
            $student->user->update(['password' => Hash::make($validated['password'])]);
        }

        $student->update([
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'kelas_id' => $validated['kelas_id'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'alamat' => $validated['alamat'] ?? null,
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Student $student)
    {
        $student->attendanceDetails()->delete();
        if ($student->user) {
            $student->user->delete();
        }
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Siswa berhasil dihapus!');
    }
}
