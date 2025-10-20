<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('studi_lanjut', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jenis_studi')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('status_studi')->nullable();
            $table->enum('lokasi', ['Dalam Negeri', 'Luar Negeri'])->nullable();
            $table->string('tempat_studi')->nullable();
            $table->string('bidang_studi')->nullable();
            $table->date('periode_awal')->nullable();
            $table->date('periode_akhir')->nullable();

            // ✅ Tugas Belajar
            $table->boolean('tugas_belajar_sk_exist')->default(false);
            $table->string('tugas_belajar_sk_nomor')->nullable();
            $table->string('tugas_belajar_sk_path')->nullable();

            // ✅ Izin Belajar
            $table->boolean('izin_belajar_exist')->default(false);
            $table->string('izin_belajar_nomor')->nullable();
            $table->string('izin_belajar_path')->nullable();

            $table->string('sumber_biaya')->nullable();
            $table->unsignedTinyInteger('progress')->default(0);
            $table->unsignedTinyInteger('progress_november_2024')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('studi_lanjut');
    }
};
