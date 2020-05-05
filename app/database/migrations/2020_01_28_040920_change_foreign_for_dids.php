<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeignForDids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('did_numbers', function (Blueprint $table) {
            //
          $table->integer('flow_id')->unsigned()->nullable()->change();
          $table->dropForeign(['flow_id']);

          $table->foreign('flow_id')
              ->references('id')
              ->on('flows')
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
        Schema::table('did_numbers', function (Blueprint $table) {
            //
        });
    }
}
