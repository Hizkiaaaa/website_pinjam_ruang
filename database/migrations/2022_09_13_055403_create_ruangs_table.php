<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lantai_id');
            $table->foreignId('gedung_id');
            $table->foreignId('user_id');
            $table->string('nomor_ruang');
            $table->string('deskripsi');
            $table->string('kapasitas');
            $table->string('foto')->nullable();
            $table->string('surat');
            $table->string('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruangs');
    }
}
