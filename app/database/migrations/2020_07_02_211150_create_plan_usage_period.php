<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanUsagePeriod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_usage_period', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('workspace_id')->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');
            $table->string('plan');
            $table->dateTime('started_at');
            $table->dateTime('renews_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->boolean('active')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plan_usage_period');
    }
}
