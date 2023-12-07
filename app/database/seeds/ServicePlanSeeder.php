<?php

use Illuminate\Database\Seeder;

use App\ServicePlan;
use App\Helpers\PlanHelper;
use App\Helpers\MainHelper;

class ServicePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $ppg_plan = ServicePlan::create([
            'key_name' => 'pay-as-you-go',
            'nice_name' => 'Pay as you go',
            'description' => 'On demand subscription',
            'pay_as_you_go' => TRUE,
            'include_in_pricing_pages' => TRUE,
            'allows_annual' => FALSE,
            'allows_monthly' => FALSE,
            'featured_plan' => FALSE,
            'rank' => 0
        ]);

        $base_cost =MainHelper::toCents(24.99);
        $basic_plan = ServicePlan::create([
            'key_name' => 'basic',
            'nice_name' => 'Basic',
            'description' => 'Basic package with all base level features.',
            'base_costs' => $base_cost,
            'minutes_per_month' => 200,
            'call_duration' => 'Unlimited',
            'recording_space' => PlanHelper::gb_to_kb( 2 ),
            'include_in_pricing_pages' => TRUE,
            'fax' => TRUE,
            'im_integrations' => TRUE,
            'productivity_integrations' => TRUE,
            'voice_analytics' => TRUE,
            'fraud_protection' => TRUE,
            'crm_integrations' => TRUE,
            'programmable_toolkit' => TRUE,
            'sso' => TRUE,
            'provisioner' => TRUE,
            'vpn' => TRUE,
            'multiple_sip_domains' => TRUE,
            'bring_carrier' => TRUE,
            'featured_plan' => TRUE,
            'pay_as_you_go' => FALSE,
            'registration_plan' => TRUE,
            'rank' => 1
        ]);

        $base_cost =MainHelper::toCents(49.99);
        $basic_plan = ServicePlan::create([
            'key_name' => 'company',
            'nice_name' => 'Company',
            'description' => 'Company package with all base level features.',
            'base_costs' => $base_cost,
            'minutes_per_month' => 200,
            'call_duration' => 'Unlimited',
            'recording_space' => PlanHelper::gb_to_kb( 2 ),
            'include_in_pricing_pages' => TRUE,
            'fax' => TRUE,
            'im_integrations' => TRUE,
            'productivity_integrations' => TRUE,
            'voice_analytics' => TRUE,
            'fraud_protection' => TRUE,
            'crm_integrations' => TRUE,
            'programmable_toolkit' => TRUE,
            'sso' => TRUE,
            'provisioner' => TRUE,
            'vpn' => TRUE,
            'multiple_sip_domains' => TRUE,
            'bring_carrier' => TRUE,
            'featured_plan' => TRUE,
            'pay_as_you_go' => FALSE,
            'registration_plan' => TRUE,
            'rank' => 2
        ]);

}
}
