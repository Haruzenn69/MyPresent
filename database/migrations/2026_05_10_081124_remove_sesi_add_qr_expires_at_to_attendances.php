<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        Schema::table('attendances', function (Blueprint $table) use ($driver) {
            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE attendances DROP COLUMN sesi');
            } else {
                $table->dropColumn('sesi');
            }

            $table->dateTime('qr_expires_at')->nullable()->after('qr_code_path');
        });
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        Schema::table('attendances', function (Blueprint $table) use ($driver) {
            $table->dropColumn('qr_expires_at');

            if ($driver === 'mysql') {
                DB::statement("ALTER TABLE attendances ADD COLUMN sesi ENUM('pagi', 'siang') DEFAULT 'pagi' AFTER qr_code_path");
            } else {
                $table->string('sesi')->default('pagi')->after('qr_code_path');
            }
        });
    }
};
