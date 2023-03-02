<?php
namespace App\Helpers;

final class PlanHelper
{
    public static function minutes_to_seconds($minutes)
    {
        return $minutes * 60;
    }
    public static function gb_to_kb($gb)
    {
        return $gb * 1024;
    }
    public static function create_plan($attrs = [])
    {
        $defaults = [
            'key_name' => '',
            'nice_name' => '',
            'base_costs' => 0.00,
            'call_duration' => 'Unlimited',
            'recording_space' => 'Unlimited',
            'minutes_per_month' => 0,
            'extensions' => 5,
            'ports' => true,
            'extensions' => 5,
            'recording_space' => 1024,
            'fax' => 100,
            'calling_between_ext' => true,
            'standard_call_feat' => true,
            'voicemail_transcriptions' => false,
            'im_integrations' => false,
            'productivity_integrations' => false,
            'voice_analytics' => false,
            'fraud_protection' => false,
            'crm_integrations' => false,
            'programmable_toolkit' => false,
            'sso' => false,
            'provisioner' => false,
            'vpn' => false,
            'multiple_sip_domains' => false,
            'bring_carrier' => false,
            'call_center' => false,
            '247_support' => false,
            'ai_calls' => false,
            'benefits' => [],
        ];
        $result = [];
        foreach ($defaults as $key => $item) {
            $result[$key] = $item;
            if (array_key_exists($key, $attrs)) {
                $result[$key] = $attrs[$key];
            }
        }
        return $result;
    }

}
