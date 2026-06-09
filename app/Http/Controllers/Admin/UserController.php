<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['teacher', 'student']);
        $currentRole = $request->role;

        if ($currentRole && in_array($currentRole, ['guru', 'siswa', 'admin'])) {
            $query->where('role', $currentRole);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class_id')) {
            $query->whereHas('student', fn($q) => $q->where('kelas_id', $request->class_id));
        }

        $users = $query->orderBy('name')->paginate(20)->withQueryString();
        $classes = ClassRoom::orderBy('nama_kelas')->get();
        return view('admin.users.index', compact('users', 'classes', 'currentRole'));
    }

    public function create(Request $request)
    {
        $classes = ClassRoom::orderBy('nama_kelas')->get();
        $subjects = Subject::orderBy('nama')->get();
        return view('admin.users.create', compact('classes', 'subjects'));
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if ($validated['role'] === 'guru') {
            Teacher::create([
                'user_id' => $user->id,
                'nip' => $validated['nip'],
                'nama' => $validated['name'],
                'bidang_studi' => $validated['bidang_studi'] ?? null,
            ]);
        }

        if ($validated['role'] === 'siswa') {
            Student::create([
                'user_id' => $user->id,
                'nis' => $validated['nis'],
                'nama' => $validated['name'],
                'kelas_id' => $validated['kelas_id'] ?? null,
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'alamat' => $validated['alamat'] ?? null,
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun berhasil dibuat!');
    }

    public function show(User $user)
    {
        $user->load(['teacher', 'student.kelas']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $classes = ClassRoom::orderBy('nama_kelas')->get();
        $subjects = Subject::orderBy('nama')->get();
        $user->load(['teacher', 'student.kelas']);
        return view('admin.users.edit', compact('user', 'classes', 'subjects'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        $teacherId = $user->teacher?->id;
        $studentId = $user->student?->id;

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        if ($user->role === 'guru') {
            $teacher = $user->teacher;
            if ($teacher) {
                $teacher->update([
                    'nip' => $validated['nip'],
                    'nama' => $validated['name'],
                    'bidang_studi' => $validated['bidang_studi'] ?? $teacher->bidang_studi,
                ]);
            } else {
                Teacher::create([
                    'user_id' => $user->id,
                    'nip' => $validated['nip'],
                    'nama' => $validated['name'],
                    'bidang_studi' => $validated['bidang_studi'] ?? null,
                ]);
            }
        }

        if ($user->role === 'siswa') {
            $student = $user->student;
            if ($student) {
                $student->update([
                    'nis' => $validated['nis'],
                    'nama' => $validated['name'],
                    'kelas_id' => $validated['kelas_id'] ?? null,
                    'jenis_kelamin' => $validated['jenis_kelamin'],
                    'alamat' => $validated['alamat'] ?? null,
                ]);
            } else {
                Student::create([
                    'user_id' => $user->id,
                    'nis' => $validated['nis'],
                    'nama' => $validated['name'],
                    'kelas_id' => $validated['kelas_id'] ?? null,
                    'jenis_kelamin' => $validated['jenis_kelamin'],
                    'alamat' => $validated['alamat'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun berhasil dihapus!');
    }
}
