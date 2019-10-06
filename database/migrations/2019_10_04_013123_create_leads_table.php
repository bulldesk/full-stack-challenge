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
            $table->integer('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('document')->nullable();
            $table->string('company')->nullable();
            $table->string('role')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('status')->nullable();
            $table->string('funnel_stage')->nullable();
            $table->string('business_title')->nullable();
            $table->string('business_value')->nullable();
            $table->integer('conversions')->nullable();
            $table->string('last_conversion')->nullable();
            $table->string('domain')->nullable();
            $table->string('register_date')->nullable();
            $table->string('url')->nullable();
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
