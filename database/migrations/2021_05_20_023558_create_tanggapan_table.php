<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanggapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->bigIncrements('id_tanggapan');
            $table->bigInteger('id_pengaduan')->unsigned();
            $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan');
            $table->date('tgl_tanggapan');
            $table->text('tanggapan');
            $table->bigInteger('id_petugas')->unsigned();
            $table->foreign('id_petugas')->references('id')->on('users');
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
        Schema::dropIfExists('tanggapan');
    }
}
