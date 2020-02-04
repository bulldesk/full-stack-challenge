<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_data', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('imported_id');
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
            $table->string('estagio_funil');
            $table->string('titulo_negocio');
            $table->string('valor_negocio');
            $table->string('conversoes');
            $table->string('ultima_conversao');
            $table->string('dominio');
            $table->string('data_cadastro');
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
        Schema::dropIfExists('csv_data');
    }
}
