<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallActionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_action_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('call_id')->unsigned();
            $table->integer('speaker_id')->unsigned()->nullable();
            $table->text('action_item');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('call_id', 'fk_actions_call_id')
                ->references('id')->on('calls')
                ->onDelete('cascade');

            $table->foreign('speaker_id', 'fk_actions_speaker_id')
                ->references('id')->on('call_speakers')
                ->onDelete('set null');

            $table->index('call_id', 'idx_call_action_items_call_id');
            $table->index('speaker_id', 'idx_call_action_items_speaker_id');
            $table->index('status', 'idx_call_action_items_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_action_items');
    }
}
