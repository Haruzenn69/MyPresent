<?php

namespace Tests\Feature\Guru;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Attendance;
use App\Models\AcademicYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    private User $guru;
    private Teacher $teacher;
    private ClassRoom $class;

    protected function setUp(): void
    {
        parent::setUp();
        $this->guru = User::factory()->create(['role' => 'guru']);
        $this->teacher = Teacher::factory()->create(['user_id' => $this->guru->id]);
        $this->class = ClassRoom::factory()->create(['wali_kelas' => $this->teacher->id]);
        AcademicYear::factory()->create(['is_active' => true]);
    }

    public function test_guru_can_view_attendances()
    {
        $response = $this->actingAs($this->guru)->get(route('guru.attendances.index'));
        $response->assertStatus(200);
    }

    public function test_guru_can_create_attendance()
    {
        $students = Student::factory()->count(3)->create(['kelas_id' => $this->class->id]);

        $response = $this->actingAs($this->guru)->post(route('guru.attendances.store'), [
            'class_id' => $this->class->id,
            'tanggal' => now()->toDateString(),
            'absensi' => [
                $students[0]->id => ['status' => 'hadir'],
                $students[1]->id => ['status' => 'sakit', 'keterangan' => 'Demam'],
                $students[2]->id => ['status' => 'alfa'],
            ],
        ]);

        $response->assertRedirect(route('guru.attendances.index'));
        $this->assertDatabaseHas('attendances', ['class_id' => $this->class->id]);
        $this->assertDatabaseHas('attendance_details', ['student_id' => $students[0]->id, 'status' => 'hadir']);
    }
}
