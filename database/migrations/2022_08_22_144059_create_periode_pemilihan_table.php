<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodePemilihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periode_pemilihan', function (Blueprint $table) {
            $table->id();
            $table->string('masa_jabatan'); 
            $table->date('tanggal_pemilihan');
            $table->time('jam_mulai_pemilihan');
            $table->time('jam_selesai_pemilihan');
            $table->integer('status'); // 0 = belum dimulai, 1 = sedang berlangsung, 2 = sudah selesai
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
        Schema::dropIfExists('periode_pemilihan');
    }
}
