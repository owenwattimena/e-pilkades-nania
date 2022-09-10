<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonKadesPeriodePemilihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_kades_periode_pemilihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calon_kades_id');
            $table->unsignedBigInteger('periode_pemilihan_id');
            $table->string('nomor_urut');

            $table->foreign('calon_kades_id')->references('id')->on('calon_kepala_desa')->onDelete('cascade');
            $table->foreign('periode_pemilihan_id')->references('id')->on('periode_pemilihan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calon_kades_periode_pemilihan');
    }
}
