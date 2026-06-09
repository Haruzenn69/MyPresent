<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_admin_can_view_students_list()
    {
        Student::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get(route('admin.students.index'));

        $response->assertStatus(200);
        $response->assertViewHas('students');
    }

    public function test_admin_can_create_student()
    {
        $class = ClassRoom::factory()->create();

        $response = $this->actingAs($this->admin)->post(route('admin.students.store'), [
            'nis' => '1234567890',
            'nama' => 'Siswa Test',
            'email' => 'siswa@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'kelas_id' => $class->id,
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Test No. 1',
        ]);

        $response->assertRedirect(route('admin.students.index'));
        $this->assertDatabaseHas('students', ['nis' => '1234567890', 'nama' => 'Siswa Test']);
        $this->assertDatabaseHas('users', ['email' => 'siswa@test.com', 'role' => 'siswa']);
    }

    public function test_admin_can_delete_student()
    {
        $student = Student::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.students.destroy', $student));

        $response->assertRedirect(route('admin.students.index'));
        $this->assertSoftDeleted($student);
    }
}
