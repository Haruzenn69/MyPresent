<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        $user = User::factory()->create(['role' => 'guru']);

        return [
            'user_id' => $user->id,
            'nip' => fake()->unique()->numerify('################'),
            'nama' => $user->name,
        ];
    }
}
