<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateByoCarriersRoutes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('byo_carriers_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('carrier_id')->unsigned();
            $table->foreign('carrier_id')->references('id')->on('byo_carriers')->onDelete('CASCADE');
            $table->string('prefix');
            $table->string('prepend');
            $table->string('match');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('byo_carriers_routes');
    }
}
