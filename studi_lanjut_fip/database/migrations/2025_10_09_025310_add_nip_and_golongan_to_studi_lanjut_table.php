<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan perubahan tabel.
     */
    public function up(): void
    {
        Schema::table('studi_lanjut', function (Blueprint $table) {
            $table->string('nip')->nullable()->after('nama');
            $table->string('golongan')->nullable()->after('nip');
        });
    }

    /**
     * Balikkan perubahan (rollback).
     */
    public function down(): void
    {
        Schema::table('studi_lanjut', function (Blueprint $table) {
            $table->dropColumn(['nip', 'golongan']);
        });
    }
};
