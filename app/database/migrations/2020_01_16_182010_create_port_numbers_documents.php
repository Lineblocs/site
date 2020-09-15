<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortNumbersDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('port_numbers_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('number_id')->unsigned();
            $table->foreign('number_id')->references('id')->on('port_numbers');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('filename');
            $table->string('document_type'); // LOA letter of auth, CSR customer service record
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('port_numbers_documents');
    }
}
