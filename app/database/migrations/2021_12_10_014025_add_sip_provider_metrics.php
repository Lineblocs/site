<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSipProviderMetrics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_providers_metrics', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('avg_answer_rate')->nullable()->default(NULL);
            $table->integer('avg_call_duration')->nullable()->default(NULL);
            $table->integer('failure_response_pct')->nullable()->default(NULL);
            $table->string('status');
            $table->integer('provider_id')->nullable()->unsigned();
            $table->foreign('provider_id')->references('id')->on('sip_providers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sip_providers_metrics');
    }
}
