<?php
namespace App\Helpers;
use \Config;
use \DateTime;
use App\Settings;

final class BillingDataHelper {
  // update this to support multiple billing gateways in the future
  public static function updateWorkspaceBilling($gateway, $billingData, $user, $workspace)
  {
    $paymentValues = $billingData['payment_values'];
    switch ( $gateway ) {
      case "stripe":
        $params = [
          'last_4' => $paymentValues['last_4'],
          'stripe_token' => $paymentValues['card_token']
        ];
        $card = MainHelper::addCard($params, $user, $workspace, TRUE, $gateway);
        return TRUE;
      break;
    }

    return FALSE;
  }
}
