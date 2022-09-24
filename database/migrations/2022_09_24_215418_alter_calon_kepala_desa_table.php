<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCalonKepalaDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon_kepala_desa', function (Blueprint $table) {
            $table->longText('visi')->change();
            $table->longText('misi')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calon_kepala_desa', function (Blueprint $table) {
            $table->string('visi')->change();
            $table->string('misi')->change();
        });
    }
}
