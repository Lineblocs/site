<?php

use App\Helpers\PlanHelper;
return [
  'pay-as-you-go' => PlanHelper::create_plan(
    'key_name' => 'pay-as-you-go',
    'nice_name' => 'Pay As You Go',

  ),
  'starter' => PlanHelper::create_plan([
    'key_name' => 'starter',
    'nice_name' => 'Starter',

    'per_month' => 24.99,
    'minutes_per_month' => 200,
    'recording_space' => PlanHelper::gb_to_kb( 2 ),
    'im_integrations' => TRUE,
    'productivity_integrations' => TRUE,
  ]),
  'pro' => PlanHelper::create_plan([
    'key_name' => 'pro',
    'nice_name' => 'Pro',

    'per_month' => 49.99,
    'minutes_per_month' => 250,
    'recording_space' => PlanHelper::gb_to_kb( 32 ),
    'extensions' => 25,
    'fax' => NULL,

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
    'bring_carrier' => TRUE
  ]),
  'ultimate' => PlanHelper::create_plan([
    'key_name' => 'ultimate',
    'nice_name' => 'Ultimate',

    'per_month' => 69.99,
    'minutes_per_month' => 500,
    'recording_space' => PlanHelper::gb_to_kb( 128 ),
    'extensions' => 100,
    'fax' => NULL,
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
    'call_center' => TRUE,
    '247_support' => TRUE,
    'ai_calls' => TRUE
  ])

];
