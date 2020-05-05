<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDidNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('did_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('number');
            $table->string('country');
            $table->string('region');
            $table->string('name');
            $table->decimal('monthly_cost',9,3);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('did_numbers');
    }
}
