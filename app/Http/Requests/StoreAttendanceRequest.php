<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'guru']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'class_id' => 'required|exists:classes,id',
            'tanggal'  => 'required|date',
            'absensi'  => 'required|array',
            'absensi.*.status' => 'required|in:hadir,sakit,izin,alfa,terlambat',
            'absensi.*.keterangan' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'class_id.required' => 'Kelas harus dipilih.',
            'tanggal.required'  => 'Tanggal harus diisi.',
            'absensi.required'  => 'Data absensi tidak boleh kosong.',
            'absensi.*.status.required' => 'Status absensi setiap siswa harus diisi.',
            'absensi.*.status.in' => 'Status absensi tidak valid.',
        ];
    }
}
