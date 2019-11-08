<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);                    // Nome
            $table->bigInteger('country_id')->unsigned(); 
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('name', 'country_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
