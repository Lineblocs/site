<?php
namespace App\Helpers;
use \Config;
use \DateTime;
use App\Settings;

final class BillingDataHelper {
  // update this to support multiple billing gateways in the future
  public static function updateWorkspaceBilling($gateway, $cardData, $user, $workspace) {
  {

    switch ( $gateway ) {
      case "stripe":
        $params = [
          'last_4' => $cardData['last_4'],
          'stripe_token' => $cardData['card_token']
        ];
        $card = MainHelper::addCard($cardData, $user, $workspace, TRUE, $gateway);
        $workspace->update([
          'billing_region_id' => $region
        ]);
      break;
    }
  }
}
