<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentImportController extends Controller
{
    public function index()
    {
        return view('admin.students.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');
        
        // Skip header
        fgetcsv($handle);

        $imported = 0;
        $errors = [];
        $line = 2;

        DB::beginTransaction();
        try {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($data) < 5) {
                    $errors[] = "Baris $line: Format data tidak lengkap.";
                    $line++;
                    continue;
                }

                $nis = trim($data[0]);
                $nama = trim($data[1]);
                $email = trim($data[2]);
                $jk = strtoupper(trim($data[3])) == 'L' ? 'Laki-laki' : 'Perempuan';
                $namaKelas = trim($data[4]);
                $alamat = trim($data[5] ?? '');

                if ($nis === '' || $nama === '' || $email === '' || $namaKelas === '') {
                    $errors[] = "Baris $line: Data wajib (NIS, Nama, Email, Kelas) tidak boleh kosong.";
                    $line++;
                    continue;
                }

                // Cari Kelas (exact match first, then fallback to LIKE with escaped input)
                $kelas = ClassRoom::where('nama_kelas', $namaKelas)->first();
                if (!$kelas) {
                    $kelas = ClassRoom::where('nama_kelas', 'like', '%' . str_replace(['%', '_'], ['\\%', '\\_'], $namaKelas) . '%')->first();
                }
                if (!$kelas) {
                    $errors[] = "Baris $line: Kelas '$namaKelas' tidak ditemukan.";
                    $line++;
                    continue;
                }

                if (Student::where('nis', $nis)->exists()) {
                    $errors[] = "Baris $line: NIS '$nis' sudah terdaftar.";
                    $line++;
                    continue;
                }

                if (User::where('email', $email)->exists()) {
                    $errors[] = "Baris $line: Email '$email' sudah digunakan.";
                    $line++;
                    continue;
                }

                $password = 'siswa123';

                $user = User::create([
                    'name' => $nama,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => 'siswa',
                ]);

                Student::create([
                    'user_id' => $user->id,
                    'nis' => $nis,
                    'nama' => $nama,
                    'kelas_id' => $kelas->id,
                    'jenis_kelamin' => $jk,
                    'alamat' => $alamat,
                ]);

                $imported++;
                $line++;
            }

            if (count($errors) > 0 && $imported == 0) {
                DB::rollBack();
                return back()->withErrors($errors);
            }

            DB::commit();
            fclose($handle);

            $msg = "Berhasil mengimpor $imported siswa. Password default: <b>siswa123</b>.";
            if (count($errors) > 0) {
                $msg .= " Namun ada beberapa baris yang bermasalah.";
                return redirect()->route('admin.users.index')->with('success', $msg)->withErrors($errors);
            }

            return redirect()->route('admin.users.index')->with('success', $msg);

        } catch (\Exception $e) {
            DB::rollBack();
            fclose($handle);
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
