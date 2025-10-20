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
        $table->string('unit_kerja')->nullable()->after('golongan');
    });
}

public function down()
{
    Schema::table('studi_lanjut', function (Blueprint $table) {
        $table->dropColumn('unit_kerja');
    });
}

};
