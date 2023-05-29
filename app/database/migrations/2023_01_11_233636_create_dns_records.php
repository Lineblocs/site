<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDnsRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dns_records', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->timestamps();
            $table->string('host')->default('')->unique(0);
            $table->string('type')->default('A');
            $table->string('value')->default('');
            $table->integer('ttl')->default(300);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dns_records');
    }
}
