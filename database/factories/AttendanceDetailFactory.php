<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AttendanceDetail>
 */
class AttendanceDetailFactory extends Factory
{
    protected $model = AttendanceDetail::class;

    public function definition(): array
    {
        return [
            'attendance_id' => Attendance::factory(),
            'student_id' => Student::factory(),
            'status' => fake()->randomElement(['hadir', 'izin', 'sakit', 'alfa', 'terlambat']),
            'keterangan' => fake()->optional(0.3)->sentence(),
        ];
    }
}
