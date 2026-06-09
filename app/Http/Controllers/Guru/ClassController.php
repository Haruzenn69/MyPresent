<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::with('waliKelas', 'students')
            ->withCount('students')
            ->orderBy('nama_kelas')
            ->get();
        return view('guru.classes.index', compact('classes'));
    }

    public function show(ClassRoom $class)
    {
        $class->load('waliKelas', 'students');
        return view('guru.classes.show', compact('class'));
    }
}
