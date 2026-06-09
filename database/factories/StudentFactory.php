<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $user = User::factory()->create(['role' => 'siswa']);

        return [
            'user_id' => $user->id,
            'nis' => fake()->unique()->numerify('##########'),
            'nama' => $user->name,
            'kelas_id' => null,
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'alamat' => fake()->address(),
        ];
    }
}
