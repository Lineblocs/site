<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddNextBillingDateToSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // The anchor for the global cycle
            $table->timestamp('next_billing_date')->nullable()->after('current_period_end')->index();
            
            // Audit field to track when the RabbitMQ worker actually finished a charge
            $table->timestamp('last_billed_at')->nullable()->after('next_billing_date');
            
            // Helpful if you want to store the prorated amount of the first "immediate" charge
            $table->decimal('last_charge_amount', 10, 2)->nullable()->after('last_billed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn(['next_billing_date', 'last_billed_at', 'last_charge_amount']);
        });
    }
}