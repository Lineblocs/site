<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_savings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('competitor_id')->unsigned()->nullable();
            $table->foreign('competitor_id')->references('id')->on('competitors')->onDelete('CASCADE');

            $table->string('country');
            $table->string('local_number_monthly')->nullable();
            $table->string('toll_free_number_monthly')->nullable();
            $table->string('sms_send_via_local_number')->nullable();
            $table->string('sms_send_via_toll_free_number')->nullable();
            $table->string('sms_send_via_short_code')->nullable();
            $table->string('sms_receive_via_short_code')->nullable();

            $table->string('mms_send_via_local_number')->nullable();
            $table->string('mms_receive_via_local_number')->nullable();

            $table->string('mms_send_via_toll_free_number')->nullable();
            $table->string('mms_receive_via_toll_free_number')->nullable();

            $table->string('mms_send_via_short_code')->nullable();
            $table->string('mms_receive_via_short_code')->nullable();

            $table->string('pstn_calls')->nullable();
            $table->string('receive_calls_on_local_number')->nullable();
            $table->string('webrtc_calling_rates')->nullable();
            $table->string('call_recordings')->nullable();
            $table->string('call_recordings_storage')->nullable();
            $table->string('conference_calls')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cost_savings');
    }
}
