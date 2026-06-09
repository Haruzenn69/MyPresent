<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return response()->json(Subject::orderBy('nama')->paginate(20));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|unique:subjects,kode',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $subject = Subject::create($request->all());
        return response()->json($subject, 201);
    }

    public function show(Subject $subject)
    {
        return response()->json($subject);
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'kode' => 'required|string|unique:subjects,kode,' . $subject->id,
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $subject->update($request->all());
        return response()->json($subject);
    }

    public function destroy(Subject $subject)
    {
        if ($subject->attendances()->exists()) {
            return response()->json(['message' => 'Mata pelajaran memiliki data absensi dan tidak bisa dihapus.'], 422);
        }
        $subject->delete();
        return response()->json(['message' => 'Mata pelajaran berhasil dihapus.']);
    }
}
