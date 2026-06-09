<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClassRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'nama_kelas' => ['required', 'string', 'max:100', Rule::unique('classes', 'nama_kelas')->whereNull('deleted_at')],
            'wali_kelas' => 'nullable|exists:teachers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kelas.required' => 'Nama kelas harus diisi.',
            'nama_kelas.unique' => 'Nama kelas sudah digunakan.',
            'wali_kelas.exists' => 'Wali kelas tidak ditemukan.',
        ];
    }
}
