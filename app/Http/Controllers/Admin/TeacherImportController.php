<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherImportController extends Controller
{
    public function index()
    {
        return view('admin.teachers.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');

        fgetcsv($handle);

        $imported = 0;
        $errors = [];
        $line = 2;

        DB::beginTransaction();
        try {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($data) < 3) {
                    $errors[] = "Baris $line: Format data tidak lengkap.";
                    $line++;
                    continue;
                }

                $nip = trim($data[0]);
                $nama = trim($data[1]);
                $email = trim($data[2]);
                $kodeMapel = trim($data[3] ?? '');

                if ($nip === '' || $nama === '' || $email === '') {
                    $errors[] = "Baris $line: Data wajib (NIP, Nama, Email) tidak boleh kosong.";
                    $line++;
                    continue;
                }

                if (User::where('email', $email)->exists()) {
                    $errors[] = "Baris $line: Email '$email' sudah digunakan.";
                    $line++;
                    continue;
                }

                if (Teacher::where('nip', $nip)->exists()) {
                    $errors[] = "Baris $line: NIP '$nip' sudah terdaftar.";
                    $line++;
                    continue;
                }

                $subject = null;
                if ($kodeMapel !== '') {
                    $subject = Subject::where('kode', $kodeMapel)->orWhere('nama', $kodeMapel)->first();
                }

                $password = 'guru123';

                $user = User::create([
                    'name' => $nama,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => 'guru',
                ]);

                Teacher::create([
                    'user_id' => $user->id,
                    'nip' => $nip,
                    'nama' => $nama,
                    'bidang_studi' => $subject?->id,
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

            $msg = "Berhasil mengimpor $imported guru. Password default: <b>guru123</b>.";
            if (count($errors) > 0) {
                $msg .= " Namun ada beberapa baris yang bermasalah.";
                return redirect()->route('admin.teachers.index')->with('success', $msg)->withErrors($errors);
            }

            return redirect()->route('admin.teachers.index')->with('success', $msg);

        } catch (\Exception $e) {
            DB::rollBack();
            fclose($handle);
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}

