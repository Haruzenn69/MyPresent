<?php

namespace App\Policies;

use App\Models\AcademicYear;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AcademicYearPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'guru']);
    }

    public function view(User $user, AcademicYear $academicYear): bool
    {
        return in_array($user->role, ['admin', 'guru']);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, AcademicYear $academicYear): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, AcademicYear $academicYear): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, AcademicYear $academicYear): bool
    {
        return false;
    }

    public function forceDelete(User $user, AcademicYear $academicYear): bool
    {
        return false;
    }
}
