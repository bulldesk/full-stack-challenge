<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaisEstadoCidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
        });

        Schema::create('estado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->unsignedInteger('id_pais');
        });


        Schema::create('cidade', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->unsignedInteger('id_estado');
        });
        
        Schema::table('cidade', function (Blueprint $table) {
            $table->foreign('id_estado')->references('id')->on('estado');
        });
        
        Schema::table('estado', function (Blueprint $table) {
            $table->foreign('id_pais')->references('id')->on('pais');
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
    }
}
