<?php

namespace App\Policies;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassRoomPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'guru']);
    }

    public function view(User $user, ClassRoom $classRoom): bool
    {
        if ($user->role === 'admin') return true;
        if ($user->role === 'guru' && $user->teacher) {
            return $classRoom->wali_kelas === $user->teacher->id;
        }
        return false;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, ClassRoom $classRoom): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, ClassRoom $classRoom): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, ClassRoom $classRoom): bool
    {
        return false;
    }

    public function forceDelete(User $user, ClassRoom $classRoom): bool
    {
        return false;
    }
}
