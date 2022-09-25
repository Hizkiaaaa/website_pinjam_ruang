<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('ruang_id');
            $table->foreignId('status_pinjaman_id');
            $table->bigInteger('id_pinjaman')->unique();
            $table->date('tanggal_pinjam');
            $table->time('jam_pinjam');
            $table->time('jam_selesai');
            $table->integer('jumlah_peserta');
            $table->string('keperluan');
            $table->string('catatan');
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
        Schema::dropIfExists('pinjamen');
    }
}