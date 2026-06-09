<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('nama')->paginate(15);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => ['required', 'string', 'max:20', Rule::unique('subjects', 'kode')->whereNull('deleted_at')],
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Subject::create($request->all());

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'kode' => ['required', 'string', 'max:20', Rule::unique('subjects', 'kode')->ignore($subject->id)->whereNull('deleted_at')],
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $subject->update($request->all());

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui!');
    }

    public function destroy(Subject $subject)
    {
        if ($subject->attendances()->exists()) {
            return back()->with('error', 'Mata pelajaran memiliki data absensi dan tidak bisa dihapus.');
        }
        $subject->delete();

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil dihapus!');
    }
}
