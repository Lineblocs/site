<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_speakers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('call_id')->unsigned();
            $table->string('speaker_name');
            $table->float('start_talk_time');
            $table->float('end_talk_time');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('call_id', 'fk_speakers_call_id')
                ->references('id')->on('calls')
                ->onDelete('cascade');

            $table->index('call_id', 'idx_call_speakers_call_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_speakers');
    }
}
