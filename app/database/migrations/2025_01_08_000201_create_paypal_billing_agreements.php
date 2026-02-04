<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaypalBillingAgreements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('billing_agreements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('workspace_id')->unsigned();
            $table->string('agreement_id');
            $table->string('state');
            $table->text('description');
            $table->dateTime('start_date');
            $table->string('payer_email');
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('workspace_id')
                  ->references('id')
                  ->on('workspaces')
                  ->onDelete('cascade');
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
        Schema::drop('billing_agreements');
    }
}
