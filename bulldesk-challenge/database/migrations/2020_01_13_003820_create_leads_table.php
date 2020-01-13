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

            $table->integer('codigo');
            $table->string('nome');
            $table->string('email');
            $table->string('cpf_cnpj');
            $table->string('empresa');
            $table->string('profissao_cargo');
            $table->string('telefone');
            $table->string('cidade');
            $table->string('estado');
            $table->string('pais');
            $table->enum('status', ['Novo']);
            $table->enum('estagio_funil', ['Lead']);
            $table->string('titulo_negocio')->nullable();
            $table->string('valor_negocio')->nullable();
            $table->integer('conversoes')->nullable();
            $table->string('ultima_conversao')->nullable();
            $table->string('dominio')->nullable();
            $table->dateTime('data_cadastro');
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
