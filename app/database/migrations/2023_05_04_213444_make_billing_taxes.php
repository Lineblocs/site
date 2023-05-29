<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeBillingTaxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->float('tax_percentage')->default(0.0);
            $table->string('name')->default(''); // e.g: GST
            $table->boolean('federal')->default(FALSE);
            $table->boolean('primary_tax')->default(FALSE);
            $table->integer('region_id')->nullable()->unsigned();
            $table->foreign('region_id')->references('id')->on('billing_regions')->onDelete('CASCADE');
            $table->integer('country_id')->nullable()->unsigned();
            $table->foreign('country_id')->references('id')->on('billing_countries')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('billing_taxes');
    }
}
