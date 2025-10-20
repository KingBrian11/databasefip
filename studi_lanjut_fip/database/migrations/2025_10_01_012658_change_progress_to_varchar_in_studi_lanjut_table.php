<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('studi_lanjut', function (Blueprint $table) {
        $table->string('progress', 100)->nullable()->change();
        $table->string('progress_november_2024', 100)->nullable()->change();
    });
}

public function down()
{
    Schema::table('studi_lanjut', function (Blueprint $table) {
        $table->integer('progress')->nullable()->change();
        $table->integer('progress_november_2024')->nullable()->change();
    });
}

};
