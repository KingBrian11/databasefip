<?php

// database/migrations/xxxx_xx_xx_create_staf_fip_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('staf_fip', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan'); // contoh: Staf Akademik
            $table->timestamps();
        });

        Schema::create('anggota_staf_fip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staf_fip_id');
            $table->string('nama');
            $table->foreign('staf_fip_id')->references('id')->on('staf_fip')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('anggota_staf_fip');
        Schema::dropIfExists('staf_fip');
    }
};
