<?php

namespace Database\Factories;

use App\Models\ClassRoom;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassRoomFactory extends Factory
{
    protected $model = ClassRoom::class;

    public function definition(): array
    {
        return [
            'nama_kelas' => fake()->randomElement(['X', 'XI', 'XII']) . ' ' . fake()->randomElement(['RPL', 'TKJ', 'MM', 'AK', 'AP']) . ' ' . fake()->numberBetween(1, 5),
            'wali_kelas' => Teacher::factory(),
        ];
    }
}
