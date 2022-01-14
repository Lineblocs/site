<?php

use App\Helpers\PlanHelper;
return [
  'pay-as-you-go' => PlanHelper::create_plan([
    'key_name' => 'pay-as-you-go',
    'nice_name' => 'Pay As You Go',
    'description' => 'On demand subscription',
    'call_duration' => 'Unlimited',
    'recording_space' => 'Unlimited',
    'benefits' => []

  ]),
  'starter' => PlanHelper::create_plan([
    'key_name' => 'starter',
    'nice_name' => 'Starter',
    'description' => 'Starter package with all base level features.',
    'per_month' => 24.99,
    'minutes_per_month' => 200,
    'call_duration' => 'Unlimited',
    'recording_space' => PlanHelper::gb_to_kb( 2 ),
    'im_integrations' => TRUE,
    'productivity_integrations' => TRUE,
    'benefits' => [
        'IM Integrations',
        'Productivity Integrations'
    ]
  ]),
  'pro' => PlanHelper::create_plan([
    'key_name' => 'pro',
    'nice_name' => 'Pro',
    'description' => 'Professional package with more features',
    'per_month' => 49.99,
    'minutes_per_month' => 250,
    'call_duration' => 'Unlimited',
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
    'bring_carrier' => TRUE,
    'benefits' => [
        'IM Integrations',
        'Productivity Integrations',
        'Fraud Protection',
        'CRM Integrations (salesforce, zoho, zendesk)',
        'Phone Provisioner',
        'Lineblocs VPN',
        'Bring Your Own Carrier',
        'Multiple SIP Domains'
    ]

  ]),
  'ultimate' => PlanHelper::create_plan([
    'key_name' => 'ultimate',
    'nice_name' => 'Ultimate',
    'description' => 'Ultimate package for enterprises',
    'per_month' => 69.99,
    'minutes_per_month' => 500,
    'call_duration' => 'Unlimited',
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
    'ai_calls' => TRUE,
    'benefits' => [

 'Call Center Apps',
 '24 / 7 Support',
 'AI Based call routing',
 'Custom Branded SIP Apps',
 'Branded Softphone Apps',
 'Dedicated Lineblocs Representitive'
    ]
  ])

];
