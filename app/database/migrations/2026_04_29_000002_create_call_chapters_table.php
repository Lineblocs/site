<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_chapters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('call_id')->unsigned();
            $table->string('title');
            $table->text('summary');
            $table->float('start_time');

            $table->foreign('call_id', 'fk_chapters_call_id')
                ->references('id')->on('calls')
                ->onDelete('cascade');

            $table->index('call_id', 'idx_call_chapters_call_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_chapters');
    }
}
