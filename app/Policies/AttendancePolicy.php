<?php

namespace App\Policies;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AttendancePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'guru';
    }

    public function view(User $user, Attendance $attendance): bool
    {
        if ($user->role === 'admin') return true;
        
        return $user->role === 'guru' && $user->teacher && $user->teacher->id === $attendance->teacher_id;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'guru';
    }

    public function update(User $user, Attendance $attendance): bool
    {
        if ($user->role === 'admin') return true;

        return $user->role === 'guru' && $user->teacher && $user->teacher->id === $attendance->teacher_id;
    }

    public function delete(User $user, Attendance $attendance): bool
    {
        if ($user->role === 'admin') return true;

        return $user->role === 'guru' && $user->teacher && $user->teacher->id === $attendance->teacher_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Attendance $attendance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Attendance $attendance): bool
    {
        return false;
    }
}
