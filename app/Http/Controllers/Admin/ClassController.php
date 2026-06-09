<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::with('waliKelas')
            ->withCount('students')
            ->orderBy('nama_kelas')
            ->paginate(15);
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = Teacher::orderBy('nama')->get();
        return view('admin.classes.create', compact('teachers'));
    }

    public function store(StoreClassRoomRequest $request)
    {
        $validated = $request->validated();
        ClassRoom::create($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function show(ClassRoom $class)
    {
        $class->load('waliKelas', 'students');
        // Siswa yang belum masuk kelas ini
        $availableStudents = Student::whereNull('kelas_id')
            ->orWhere('kelas_id', '!=', $class->id)
            ->orderBy('nama')->get();
        return view('admin.classes.show', compact('class', 'availableStudents'));
    }

    public function edit(ClassRoom $class)
	{
    	$teachers = Teacher::orderBy('nama')->get();
    	$class->refresh(); // Refresh the class model to ensure relationships are up-to-date
    	$class->load('waliKelas', 'students');
    
    	$availableStudents = Student::where(function($query) use ($class) {
        	$query->whereNull('kelas_id')
              	->orWhere('kelas_id', '!=', $class->id);
        })->with('kelas')->orderBy('nama')->get();

        return view('admin.classes.edit', compact('class', 'teachers', 'availableStudents'));
    }

    public function update(UpdateClassRoomRequest $request, ClassRoom $class)
    {
        $validated = $request->validated();
        $class->update($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil diperbarui!');
    }

    public function destroy(ClassRoom $class)
    {
        if ($class->students()->count() > 0) {
            return redirect()->route('admin.classes.index')
                ->with('error', 'Kelas tidak bisa dihapus karena masih memiliki siswa.');
        }

        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil dihapus!');
    }

    // Tambah siswa ke kelas
    public function addStudent(Request $request, ClassRoom $class)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $student = Student::findOrFail($request->student_id);
        $student->kelas_id = $class->id;
        $student->save();

        return redirect()->route('admin.classes.edit', $class)
            ->with('success', 'Siswa berhasil ditambahkan ke kelas!');
    }

    // Hapus siswa dari kelas
    public function removeStudent(ClassRoom $class, Student $student)
    {
        $student->kelas_id = null;
        $student->save();

        return redirect()->route('admin.classes.edit', $class)
            ->with('success', 'Siswa berhasil dikeluarkan dari kelas!');
    }
}
