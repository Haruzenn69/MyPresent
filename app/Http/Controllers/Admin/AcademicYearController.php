<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcademicYearRequest;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index()
    {
        $years = AcademicYear::orderByDesc('year')->orderByDesc('semester')->get();
        return view('admin.academic_years.index', compact('years'));
    }

    public function store(StoreAcademicYearRequest $request)
    {
        $validated = $request->validated();
        AcademicYear::create($validated);

        return redirect()->route('admin.academic-years.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan!');
    }

    public function activate(AcademicYear $academicYear)
    {
        // Deactivate all others
        AcademicYear::where('is_active', true)->update(['is_active' => false]);

        // Activate this one
        $academicYear->update(['is_active' => true]);

        return redirect()->route('admin.academic-years.index')
            ->with('success', 'Tahun ajaran ' . $academicYear->year . ' (' . ucfirst($academicYear->semester) . ') berhasil diaktifkan!');
    }

    public function destroy(AcademicYear $academicYear)
    {
        if ($academicYear->is_active) {
            return back()->with('error', 'Tahun ajaran aktif tidak bisa dihapus.');
        }

        if ($academicYear->attendances()->exists()) {
            return back()->with('error', 'Tahun ajaran ini sudah memiliki data absensi dan tidak bisa dihapus.');
        }

        $academicYear->delete();

        return redirect()->route('admin.academic-years.index')
            ->with('success', 'Tahun ajaran berhasil dihapus!');
    }
}
