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
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('cpfcnpj')->nullable();
            $table->string('company')->nullable();
            $table->string('occupation')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('status')->nullable();
            $table->string('stage')->nullable();
            $table->string('business_title')->nullable();
            $table->string('business_value')->nullable();
            $table->string('conversions')->nullable();
            $table->string('last_conversion')->nullable();
            $table->string('domain')->nullable();
            $table->string('register_date')->nullable();
            $table->string('url')->nullable();
            $table->integer('import_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->foreign('import_id')->references('id')->on('imports');
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
