<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;

class ServicePlan extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $casts  = array(
  'fax' => 'boolean',
  'im_integrations' => 'boolean',
  'productivity_integrations' => 'boolean',
  'voice_analytics' => 'boolean',
  'fraud_protection' => 'boolean',
  'crm_integrations' => 'boolean',
  'programmable_toolkit' => 'boolean',
  'sso' => 'boolean',
  'provisioner' => 'boolean',
  'vpn' => 'boolean',
  'multiple_sip_domains' => 'boolean',
  'bring_carrier' => 'boolean',
  'featured_plan' => 'boolean',
  'pay_as_you_go' => 'boolean',
  'registration_plan' => 'boolean',
  'include_in_pricing_pages' => 'boolean'
  );
  protected $table ='service_plans';
  public static function sortPlansByFeatures( $plans )
  {
    return $plans;
  }

  public function isFeatured()
  {
    return $this->featured_plan;
  }
  public function isPrepaid()
  {
    return $this->pay_as_you_go;
  }

  public function getFormattedMonthlyCharge()
  {
    $cents = $this->base_costs;
    return number_format(($cents /100), 2, '.', ' ');
  }

  public function getPricingDollars()
  {
    $charge = $this->getFormattedMonthlyCharge();
    $pieces = explode(".", $charge);
    return $pieces[0];
  }

  public function getPricingDecimels()
  {
    $charge = $this->getFormattedMonthlyCharge();
    $pieces = explode(".", $charge);
    return $pieces[1];
  }
  public static function getFeatureDescription( $feature ) {
    return $feature;
  }
  public static function getPayAsYouGoplan() {
    return self::where('pay_as_you_go', '1')->firstOrFail();
  }

  public static function getRecurringMembershipPlans() {
    return self::where('pay_as_you_go', '0')->get();
  }

}
