<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicePlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('key_name')->default('');
            $table->string('nice_name')->default('');
            $table->string('description')->default('');
            $table->string('call_duration')->default('');
            $table->string('recording_space')->default('');
            $table->boolean('extensions')->default(FALSE);
            $table->boolean('fax')->default(FALSE);
            $table->boolean('im_integrations')->default(FALSE);
            $table->boolean('productivity_integrations')->default(FALSE);
            $table->boolean('voice_analytics')->default(FALSE);
            $table->boolean('fraud_protection')->default(FALSE);
            $table->boolean('crm_integrations')->default(FALSE);
            $table->boolean('programmable_toolkit')->default(FALSE);
            $table->boolean('sso')->default(FALSE);
            $table->boolean('provisioner')->default(FALSE);
            $table->boolean('vpn')->default(FALSE);
            $table->boolean('multiple_sip_domains')->default(FALSE);
            $table->boolean('bring_carrier')->default(FALSE);
            // only one can be featured
            $table->boolean('featured_plan')->default(FALSE);
            $table->integer('monthly_charge_cents')->default(0);
            $table->integer('base_costs')->default(0);
            $table->boolean('pay_as_you_go')->default(FALSE);

            $table->boolean('247_support')->default(FALSE);
            $table->boolean('ai_calls')->default(FALSE);
            $table->string('benefits')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('service_plans');
    }
}
