<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Rizqi',
            'email' => 'admin@present.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
