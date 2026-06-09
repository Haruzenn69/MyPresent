<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\AcademicYear;
use App\Models\ClassRoom;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition(): array
    {
        return [
            'class_id' => ClassRoom::factory(),
            'teacher_id' => Teacher::factory(),
            'tanggal' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'academic_year_id' => AcademicYear::factory()->active(),
        ];
    }
}
