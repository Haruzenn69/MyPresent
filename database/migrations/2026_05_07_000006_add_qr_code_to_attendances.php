<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->string('qr_code_token')->nullable()->unique()->after('tanggal');
            $table->string('qr_code_path')->nullable()->after('qr_code_token');
            $table->enum('sesi', ['pagi', 'siang'])->default('pagi')->after('qr_code_path');
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn(['qr_code_token', 'qr_code_path', 'sesi']);
        });
    }
};
