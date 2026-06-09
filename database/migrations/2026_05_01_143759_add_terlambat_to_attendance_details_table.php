<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE attendance_details MODIFY COLUMN status ENUM('hadir', 'sakit', 'izin', 'alfa', 'terlambat') NOT NULL DEFAULT 'hadir'");
        }
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE attendance_details MODIFY COLUMN status ENUM('hadir', 'sakit', 'izin', 'alfa') NOT NULL DEFAULT 'hadir'");
        }
    }
};
