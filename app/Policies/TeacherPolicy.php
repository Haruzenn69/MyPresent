<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeacherPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function view(User $user, Teacher $teacher): bool
    {
        return $user->role === 'admin' || ($user->role === 'guru' && $user->teacher && $user->teacher->id === $teacher->id);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Teacher $teacher): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Teacher $teacher): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, Teacher $teacher): bool
    {
        return false;
    }

    public function forceDelete(User $user, Teacher $teacher): bool
    {
        return false;
    }
}
