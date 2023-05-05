<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesLineItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_invoices_line_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('is_recurring')->default(FALSE); // recurring option for charges like DID rentals or membership fees
            $table->string('key_name')->nullable(); // call_costs, recording_costs, etc...
            $table->string('name')->nullable(); // Call costs, Recording costs, etc...
            $table->float('cents')->default(0); // number of cents charged
            $table->integer('invoice_id')->nullable()->unsigned();
            $table->foreign('invoice_id')->references('id')->on('users_invoices')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_invoices_line_items');
    }
}
