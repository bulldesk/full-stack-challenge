<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Leads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->integer('id');
            $table->string('nome');
            $table->string('cpf_cnpj');
            $table->string('profissao');
            $table->string('empresa');
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
            $table->integer('#');
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
