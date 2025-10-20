<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staf_prodi', function (Blueprint $table) {
            $table->id();
            $table->string('program_studi');
            $table->string('nama');
            $table->string('jabatan')->nullable();
            $table->string('nip')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staf_prodi');
    }
};
