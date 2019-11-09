<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /**
         * Nome
         *E-mail 
         *CPF / CNPJ 
         *Empresa 
         *Profissão / Cargo 
         *Telefone 
         *Cidade 
         *Estado 
         *País 
         *Status 
         *Estágio do Funil 
         *Título do Negócio 
         *Valor do Negócio 
         *Conversões 
         *Última Conversão 
         *Domínio 
         *Data de Cadastro 
         *URL
         * 
         * 
         */
        Schema::create('leeds', function (Blueprint $table) {            
            $table->bigIncrements('id');
            $table->string('code', 100)->unique();             //Codigo externo
            $table->string('name', 200);                        // Nome
            $table->string('email', 100);                       // Email
            $table->string('cpf',14);                              // Cpf|cnpj
            $table->string('job', 100);                         // Profissão / Cargo 
            $table->string('phone', 100);                       // Telefone 
            $table->string('title', 100);                       // Título do Negócio 
            $table->decimal('value', 10, 2);                    // Valor do Negócio
            $table->integer('conversions');                     // Conversões 
            $table->longText('last_conversions');               // Última Conversão 
            $table->longText('domain');                         // Domínio
            $table->dateTime('registration_date');              // Data de Cadastro
            $table->longText('url');                            // URL
            $table->bigInteger('company_id')->unsigned();       // Empresa
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade');
            $table->bigInteger('city_id')->unsigned();          // Endereço Cidade/Estado/Pais 
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onUpdate('cascade');
            $table->bigInteger('leed_status_id')->unsigned();   // Status
            $table->foreign('leed_status_id')
                ->references('id')
                ->on('leed_statuses')
                ->onUpdate('cascade');
            $table->bigInteger('leed_states_id')->unsigned();   // Estágio do Funil
            $table->foreign('leed_states_id')
                ->references('id')
                ->on('leed_states')
                ->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leeds');
    }
}
