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

    } elseif ($phone->phone_type==7
    || $phone->phone_type==8
    || $phone->phone_type==9
    || $phone->phone_type==10) {
      PhoneProvisionHelper::provision_ciscoSPA_config($workspace, $phone);
    } elseif ($phone->phone_type==11
    || $phone->phone_type==12) {
      PhoneProvisionHelper::provision_polycomIP3XX_config($workspace, $phone);
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
    $stripped = $phone->getStrippedMacAddress();
    $this->provisionPhone($phone, "cfg".$stripped.".xml", $xml_data);
  }
  public function provisionPhone($phone, $file, $xml_data)
  {
    $s3 = \Storage::disk('s3');
    $provision_path_local = \Config::get("provision.path");
    $filePath = '/provisioning/' . $file;
    $result = $s3->put($filePath, file_get_contents($file), 'public'); 
    if ($result) {
      $phone->update([
        'needs_provisioning' => TRUE,
        'provision_error' => 'Could not deploy config'
      ]);
      return FALSE;
    }
    $phone->update([
        'needs_provisioning' => FALSE,
        'provision_error' => ''
      ]);
      return TRUE;
  }



  public static function provision_ciscoSPA_config($workspace, $phone) {
    //Loop through defaults, get global, group, and indiv
      $defaults = PhoneDefault::where('phone_type', $phone->phone_type)->get();
      $xml_data = "<flat-profile>\r\n";
      foreach ($defaults as $default) {
        $this_pValue = $default['setting_variable_name'];
        $this_current = $default['setting_option_1'];
        $this_default = $default['setting_option_1'];
        $xml_attrs = $default['xml_attrs'];
        $this_current = $this->resolvePValue($phone, $default);
        //this_pValue stores P-VALUE, and $this_current stores SETTING VALUE
        if ($this_current!=$this_default)
        {
          $xmlAttrs = $this->createXMLAttrs($xml_attrs);
          $xml_data.="<$this_pValue $xmlAttrs>$this_current</$this_pValue>";
        }
      }
    $stripped = $phone->getStrippedMacAddress();
    $this->provisionPhone($phone, "SPA-".$stripped.".xml", $xml_data);
  }
  public static function provision_polycomIP3XX_config($workspace, $phone) {
    //Loop through defaults, get global, group, and indiv
      $defaults = PhoneDefault::where('phone_type', $phone->phone_type)->get();
      $xml_data = "<sip>\r\n";
      $xml_data = "<userinfo>\r\n";
      $defaults = PhoneDefault::where('category', 'Server Info')->get();
      $phone = "1";
      $xml_data = "<server \r\n";
      foreach ($defaults as $default) {
          $this_pValue = $default['setting_variable_name'];
          $this_default = $default['setting_option_1'];
          $this_current = $this->resolvePValue($phone, $default);
          //this_pValue stores P-VALUE, and $this_current stores SETTING VALUE
          if ($this_current!=$this_default)
          {
            $xml_data.="voIpProt.server.$phone.$this_pValue=\"$this_current\"\r\n";
          }
      }
      $xml_data .= "/>";
      $defaults = PhoneDefault::where('category', 'Reg Info')->get();
      $xml_data = "<reg \r\n";
      foreach ($defaults as $default) {
          $this_pValue = $default['setting_variable_name'];
          $this_default = $default['setting_option_1'];
          $this_current = $this->resolvePValue($phone, $default);
          //this_pValue stores P-VALUE, and $this_current stores SETTING VALUE
          if ($this_current!=$this_default)
          {
            $xml_data.="reg.$phone.$this_pValue=\"$this_current\"\r\n";
          }
      }
      $xml_data .= "/>";
      $xml_data .= "</userinfo>\r\n";
      $defaults = PhoneDefault::where('category', 'TCP IP App')->get();
      $phone = "1";
      $xml_data = "<tcpIpApp><sntp\r\n";
      foreach ($defaults as $default) {
          $this_pValue = $default['setting_variable_name'];
          $this_default = $default['setting_option_1'];
          $this_current = $this->resolvePValue($phone, $default);
          //this_pValue stores P-VALUE, and $this_current stores SETTING VALUE
          if ($this_current!=$this_default)
          {
            $xml_data.="tcpIpApp.sntp.$this_pValue=\"$this_current\"\r\n";
          }
      }
      $xml_data .= "/>\r\n";
      $xml_data .= "</tcpIpApp>\r\n";
      $xml_data .= "</sip>";
    $stripped = $phone->getStrippedMacAddress();
      $this->provisionPhone($phone, $stripped.".cfg", $xml_data);
  }

  public function createXMLAttrs($attrs=NULL) {
    $result = "";
    if ( !empty( $attrs ) ) {
      foreacH ($attrs as $key => $attr) {
        $result .= " $key=\"$attr\"";
      }
    }
    return $result;

  }
  public function resolvePValue($phone, $default) {
      $this_pValue = $default['setting_variable_name'];
        $this_current = $default['setting_option_1'];
        $this_default = $default['setting_option_1'];
        $xml_attrs = $default['xml_attrs'];
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
        return $this_current;
      }

  public static function importDefaults($defs, $phoneTypes=[]) {
      foreach ($phoneTypes as $phoneType) {
        foreach ($defs as $def) {
           $category = $def['category']; 
          foreach ($def['options'] as $option) {
            //echo "adding option: ".PHP_EOL;
            //echo var_dump($option);
            $variable = $option['name'];
            if (!empty($option['variable_name'])) {
              $variable = $option['variable_name'];
            }
            $attrs = [
                'phone_type' => $phoneType,
                'category_name' => $category,
                'setting_variable_name' => $variable,
                'setting_name' => $option['name'],
                'setting_description' => '',
                'setting_variable_type' => $option['type']
            ];
            if ( !empty( $option['xml_attrs'] ) ) {
                $attrs['xml_attrs'] = json_encode($option['xml_attrs']);
            }
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
