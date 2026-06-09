<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Teacher;
use App\Models\AcademicYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_admin_can_view_attendances()
    {
        AcademicYear::factory()->create(['is_active' => true]);
        Attendance::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get(route('admin.attendances.index'));
        $response->assertStatus(200);
    }

    public function test_admin_can_view_rekap()
    {
        AcademicYear::factory()->create(['is_active' => true]);
        $class = ClassRoom::factory()->create();

        $response = $this->actingAs($this->admin)->get(route('admin.attendances.rekap'));
        $response->assertStatus(200);
    }
}
