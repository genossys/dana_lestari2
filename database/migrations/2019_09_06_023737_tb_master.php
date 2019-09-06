<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_kredit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('nohp');
            $table->string('email');
            $table->string('domisili');
            $table->string('pekerjaan');
            $table->string('jaminan');
            $table->bigInteger('pinjaman');
            $table->timestamps();
        });
        Schema::create('tb_deposito', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nam');
            $table->string('nohp');
            $table->string('email');
            $table->string('domisili');
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
        //
        Schema::dropIfExists('tb_kredit');
        Schema::dropIfExists('tb_deposito');
    }
}
