<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('e-mail');
            $table->integer('cpfcnpj');
            $table->string('empresa');
            $table->string('profissaocargo');
            $table->string('telefone');
            $table->string('cidade');
            $table->string('estado');
            $table->string('pais');
            $table->string('status');
            $table->string('estagiodofunil');
            $table->string('titulodonegocio');
            $table->string('valordonegocio');
            $table->integer('conversoes');
            $table->string('ultimaconversao');
            $table->string('dominio');
            $table->dateTime('datadecadastro');
            $table->string('url');
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
        Schema::dropIfExists('leads');
    }
}
