<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer("lead");
            $table->string("nome", 100);
            $table->string("email", 100);
            $table->string("cpf_cnpj", 14);
            $table->string("empresa", 100);
            $table->string("profissao_cargo", 100);
            $table->string("telefone", 30);
            $table->string("cidade", 100);
            $table->string("estado", 100);
            $table->string("pais", 100);
            $table->string("status", 10);
            $table->string("estagio_do_funil", 30);
            $table->string("titulo_do_negocio")->nullable();
            $table->float("valor_do_negocio", 10)->nullable();
            $table->integer("conversoes");
            $table->string("ultima_conversao", 30);
            $table->string("dominio", 100)->nullable();
            $table->string("data_de_cadastro");
            $table->string("url");
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
