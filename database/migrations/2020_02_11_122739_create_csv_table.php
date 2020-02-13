<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('email');
            $table->string('cpf_cnpj');
            $table->string('empresa');
            $table->string('profissao_cargo');
            $table->string('telefone');
            $table->string('cidade');
            $table->string('estado');
            $table->string('pais');
            $table->string('status');
            $table->string('estagioDoFunil');
            $table->string('tituloDoNegocio');
            $table->string('ValorDoNegocio');
            $table->string('conversoes');
            $table->string('ultimaConversao');
            $table->string('dominio');
            $table->string('dataDeCadastro');
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
        Schema::dropIfExists('csv');
    }
}
