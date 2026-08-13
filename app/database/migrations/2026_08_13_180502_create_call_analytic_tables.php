<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCallAnalyticTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Network & Quality of Service Metrics
        Schema::create('call_quality_metrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('call_id')->unsigned();
            $table->integer('workspace_id')->unsigned();
            
            $table->decimal('mos_score', 3, 2)->nullable();
            $table->decimal('jitter_ms_avg', 6, 2)->nullable();
            $table->decimal('jitter_ms_max', 6, 2)->nullable();
            $table->decimal('packet_loss_pct', 5, 2)->nullable();
            $table->integer('rtt_ms')->unsigned()->nullable();
            $table->string('audio_codec', 50)->nullable();
            $table->string('user_agent', 255)->nullable();
            
            $table->timestamps();

            // Foreign keys & Indexes
            $table->foreign('call_id')->references('id')->on('calls')->onDelete('cascade');
            $table->index(['workspace_id', 'call_id']);
            $table->index('mos_score');
        });

        // 2. Call Lifecycle Events
        Schema::create('call_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('call_id')->unsigned();
            $table->integer('workspace_id')->unsigned();
            
            $table->enum('event_type', [
                'initiated', 'ringing', 'answered', 
                'hold_start', 'hold_end', 
                'mute_start', 'mute_end', 
                'transfer_initiated', 'transfer_completed', 
                'ended'
            ]);
            
            $table->integer('duration')->unsigned()->default(0);
            $table->integer('triggered_by_user_id')->unsigned()->nullable();
            $table->text('event_data')->nullable(); // Model cast: 'array'
            $table->dateTime('occurred_at');

            // Foreign keys & Indexes
            $table->foreign('call_id')->references('id')->on('calls')->onDelete('cascade');
            $table->index(['call_id', 'event_type']);
            $table->index(['workspace_id', 'event_type', 'occurred_at']);
        });

        // 3. Conversation & AI Analytics
        Schema::create('call_ai_analytics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('call_id')->unsigned()->unique();
            $table->integer('workspace_id')->unsigned();
            
            $table->enum('overall_sentiment', ['positive', 'neutral', 'negative'])->default('neutral');
            $table->decimal('sentiment_score', 4, 3)->nullable();
            
            $table->integer('agent_talk_time')->unsigned()->default(0);
            $table->integer('caller_talk_time')->unsigned()->default(0);
            $table->integer('silence_time')->unsigned()->default(0);
            $table->integer('overlap_time')->unsigned()->default(0);
            
            $table->text('summary')->nullable();
            $table->text('keywords_detected')->nullable(); // Model cast: 'array'
            
            $table->timestamps();

            // Foreign keys & Indexes
            $table->foreign('call_id')->references('id')->on('calls')->onDelete('cascade');
            $table->index(['workspace_id', 'overall_sentiment']);
        });

        // 4. Pre-Aggregated Daily Rollups
        Schema::create('call_analytics_daily_workspaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('workspace_id')->unsigned();
            $table->date('date');
            
            $table->integer('total_calls')->unsigned()->default(0);
            $table->integer('inbound_calls')->unsigned()->default(0);
            $table->integer('outbound_calls')->unsigned()->default(0);
            $table->integer('answered_calls')->unsigned()->default(0);
            $table->integer('missed_calls')->unsigned()->default(0);
            $table->integer('failed_calls')->unsigned()->default(0);
            
            $table->integer('total_duration')->unsigned()->default(0);
            $table->integer('total_billable_duration')->unsigned()->default(0);
            $table->integer('avg_call_duration')->unsigned()->default(0);
            $table->integer('avg_hold_duration')->unsigned()->default(0);
            
            $table->decimal('avg_mos_score', 3, 2)->nullable();
            
            $table->timestamps();

            // Indexes
            $table->unique(['workspace_id', 'date']);
            $table->index(['date', 'workspace_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_analytics_daily_workspaces');
        Schema::dropIfExists('call_ai_analytics');
        Schema::dropIfExists('call_events');
        Schema::dropIfExists('call_quality_metrics');
    }
}