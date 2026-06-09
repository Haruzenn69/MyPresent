<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        $userId = $this->user->id;
        $teacherId = $this->user->teacher?->id;
        $studentId = $this->user->student?->id;

        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)->whereNull('deleted_at')],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'nip' => ['nullable', 'required_if:role,guru', $teacherId ? Rule::unique('teachers', 'nip')->ignore($teacherId)->whereNull('deleted_at') : Rule::unique('teachers', 'nip')->whereNull('deleted_at')],
            'bidang_studi' => ['nullable', 'exists:subjects,id'],
            'nis' => ['nullable', 'required_if:role,siswa', $studentId ? Rule::unique('students', 'nis')->ignore($studentId)->whereNull('deleted_at') : Rule::unique('students', 'nis')->whereNull('deleted_at')],
            'kelas_id' => 'nullable|required_if:role,siswa|exists:classes,id',
            'jenis_kelamin' => 'nullable|required_if:role,siswa|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nip.required_if' => 'NIP wajib diisi untuk guru.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nis.required_if' => 'NIS wajib diisi untuk siswa.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'kelas_id.required_if' => 'Kelas wajib diisi untuk siswa.',
            'kelas_id.exists' => 'Kelas tidak ditemukan.',
            'jenis_kelamin.required_if' => 'Jenis kelamin wajib diisi untuk siswa.',
        ];
    }
}
