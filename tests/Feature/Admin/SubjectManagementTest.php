<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubjectManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_admin_can_view_subjects()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.subjects.index'));
        $response->assertStatus(200);
    }

    public function test_admin_can_create_subject()
    {
        $response = $this->actingAs($this->admin)->post(route('admin.subjects.store'), [
            'kode' => 'MTK',
            'nama' => 'Matematika',
            'deskripsi' => 'Mata pelajaran Matematika',
        ]);

        $response->assertRedirect(route('admin.subjects.index'));
        $this->assertDatabaseHas('subjects', ['kode' => 'MTK', 'nama' => 'Matematika']);
    }

    public function test_admin_can_delete_subject()
    {
        $subject = Subject::factory()->create();
        $response = $this->actingAs($this->admin)->delete(route('admin.subjects.destroy', $subject));
        $response->assertRedirect(route('admin.subjects.index'));
        $this->assertSoftDeleted($subject);
    }
}
