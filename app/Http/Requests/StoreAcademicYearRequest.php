<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAcademicYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'year' => 'required|string|max:20',
            'semester' => 'required|in:ganjil,genap',
        ];
    }

    public function messages(): array
    {
        return [
            'year.required' => 'Tahun ajaran harus diisi.',
            'semester.required' => 'Semester harus dipilih.',
            'semester.in' => 'Semester tidak valid.',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $exists = \App\Models\AcademicYear::where('year', $this->year)
                ->where('semester', $this->semester)
                ->whereNull('deleted_at')
                ->exists();

            if ($exists) {
                $validator->errors()->add('year', 'Tahun ajaran dan semester tersebut sudah ada.');
            }
        });
    }
}
