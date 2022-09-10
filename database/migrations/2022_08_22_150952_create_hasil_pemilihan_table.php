<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilPemilihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_pemilihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calon_kades_periode_pemilihan_id');
            $table->unsignedBigInteger('pemilih_id');
            $table->timestamps();

            $table->foreign('calon_kades_periode_pemilihan_id')->references('id')->on('calon_kades_periode_pemilihan')->onDelete('cascade');
            $table->foreign('pemilih_id')->references('id')->on('pemilih')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_pemilihan');
    }
}
