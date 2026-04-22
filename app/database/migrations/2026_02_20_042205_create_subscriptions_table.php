<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps(); // Standard created_at and updated_at
            
            // Core Relationships
            $table->unsignedInteger('workspace_id');
            $table->foreign('workspace_id')
                  ->references('id')->on('workspaces')
                  ->onDelete('cascade');

            // Active State
            $table->unsignedInteger('current_plan_id');
            $table->foreign('current_plan_id')
                  ->references('id')->on('service_plans');
                  
            $table->enum('billing_cycle', ['MONTHLY', 'ANNUAL']);
            $table->string('status', 50)->default('ACTIVE'); // ACTIVE, PAST_DUE, CANCELED, etc.
            $table->timestamp('current_period_end');

            // Scheduled State (for graceful upgrades)
            $table->unsignedInteger('scheduled_plan_id')->nullable();
            $table->foreign('scheduled_plan_id')
                  ->references('id')->on('service_plans');
                  
            $table->timestamp('scheduled_effective_date')->nullable();

            // External Gateway Link
            $table->string('provider_subscription_id')->nullable()->unique();
            
            // Standard Index for the daily cron job query
            $table->index('scheduled_effective_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}