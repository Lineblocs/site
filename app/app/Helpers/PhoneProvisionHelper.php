<?php
namespace App\Helpers;
use Config;
use DB;

use App\User;
use App\Phone;
use App\PhoneDefault;
use App\PhoneGlobalSetting;
use App\PhoneGlobalSettingValue;
use App\PhoneIndividualSetting;
use App\PhoneIndividualSettingValue;

final class PhoneProvisionHelper {
  public static function provision($workspace, $phone) {
    PhoneProvisionHelper::provision_phone_config($workspace, $phone);
  }
  public static function provision_phone_config($workspace, $phone) {
    if ($phone->phone_type==1
    || $phone->phone_type==2
    || $phone->phone_type==3
    || $phone->phone_type==4) {
      PhoneProvisionHelper::provision_grandstream_config($workspace, $phone);

    }

  }
  public static function provision_grandstream_config($workspace, $phone) {
		//Based on $device_type, generate a config and return success/fail
      //GXP2130/40/60
      $mac_address = $phone->mac_address;
    $xml_data = '<?xml version="1.0" encoding="UTF-8" ?>
<gs_provision version="1">
  <mac>'.strtoupper($mac_address).'</mac>
  <config version="1">
';
    //Loop through defaults, get global, group, and indiv
      $defaults = PhoneDefault::where('phone_type', $phone->phone_type)->get();
      foreach ($defaults as $default) {
        $this_pValue = $default['setting_variable_name'];
        $this_current = $default['setting_option_1'];
        $this_default = $default['setting_option_1'];
        if ($this_pValue==="P237")
        {
          $url = $workspace->provisionURL();
          //Inject server address
          $xml_data.='			<P237>'.str_replace("http://", "", $url).'</P237>
'; //END IN CRLF!
        }
        else
        {
          //We have a pValue and its default setting. Get the group's setting, then the individual setting
          $gSetting = PhoneGlobalSetting::where('phone_type', $phone->phone_type)->first();
          if ($gSetting)
          {
            //There is the ANY GROUP setting!
            $value = PhoneGlobalSettingValue::where('setting_id', $gSetting->id)->where('setting_variable_name', $this_pValue)->first();
            if ($value) {
              $this_current=urldecode($value['setting_option_1']);
            }
          }
          $iSetting = PhoneIndividualSetting::where('phone_id', $phone->id)->first();
          if ($iSetting)
          {
            //There is the ANY GROUP setting!
            $value = PhoneIndividualSettingValue::where('setting_id', $iSetting->id)->where('setting_variable_name', $this_pValue)->first();
            if ($value) {
              $this_current=urldecode($value['setting_option_1']);
            }
          }
          //this_pValue stores P-VALUE, and $this_current stores SETTING VALUE
          if ($this_current!=$this_default)
          {
            $this_current=str_replace("!PLUS!", "+", $this_current);
            $xml_data.='			<'.$this_pValue.'>'.$this_current.'</'.$this_pValue.'>
'; //END IN CRLF!
          }
      }
    }
  $xml_data.='		</config>
</gs_provision>';
//XML compiled, write to file
    $provision_path_local = Config::get("provision.path");
    $stripped = $phone->getStrippedMacAddress();
    if (!file_put_contents(rtrim($provision_path_local,'/')."/cfg".$stripped.".xml", $xml_data)) {
      return;
    }
    $phone->update([
      'needs_provisioning' => FALSE
    ]);
  }

  public static function importDefaults($defs, $phoneTypes=[]) {
      foreach ($phoneTypes as $phoneType) {
        foreach ($defs as $def) {
           $category = $def['category']; 
          foreach ($def['options'] as $option) {
            echo "adding option: ".PHP_EOL;
            echo var_dump($option);
            $attrs = [
                'phone_type' => $phoneType,
                'category_name' => $category,
                'setting_variable_name' => $option['name'],
                'setting_name' => $option['name'],
                'setting_description' => '',
                'setting_variable_type' => $option['type']
            ];
            if ($option['type'] == '1') {
              foreach ($option['options'] as $cnt => $childOption) {
                  $tag = $cnt+1;
                  $attrs["setting_option_${tag}"] = $childOption;
                  $attrs["setting_option_${tag}_name"] = $childOption;
              }
            } elseif ($option['type'] == '2') {
                if ( !empty($option['default']) ) {
                  $default = $option['default'];
                  $attrs["setting_option_1"] = $default;
                  $attrs["setting_option_1_name"] = $default;
              }
            }
            PhoneDefault::create($attrs);
          }
      }
    }
      
  }

}
