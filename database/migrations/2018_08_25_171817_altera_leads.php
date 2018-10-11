<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteraLeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   

        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('empresa');
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->unsignedInteger('id_cidade');
            $table->foreign('id_cidade')->references('id')->on('cidade');
            $table->unsignedInteger('id_empresa');
            $table->foreign('id_empresa')->references('id')->on('empresa');
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
