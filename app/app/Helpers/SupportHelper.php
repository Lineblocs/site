<?php
namespace App\Helpers;
use \Config;
use \DateTime;
use App\Settings;
use App\Customizations;
use App\CustomizationsKVStore;
use App\ApiCredential;
use \HaydenPierce\ClassFinder\ClassFinder;
use Zendesk\API\HttpClient as ZendeskAPI;
use Exception;
use Log;

final class SupportHelper {
  public static function getClient() {
    $creds = ApiCredential::getRecord();
    $subdomain = $creds->zendesk_subdomain;
    $username  = $creds->zendesk_username;
    $token  = $creds->zendesk_token;

    $client = new ZendeskAPI($subdomain);
    $client->setAuth('basic', ['username' => $username, 'token' => $token]);
    return $client;
  }

  public static function createTicket($subject, $comment, $priority, $args=array()) {
    $customizations = CustomizationskVStore::getRecord();
    $zendeskEnabled = $customizations->zendesk_enabled;

    if (!$zendeskEnabled) {
      return NULL;
    }
    $client = self::getClient();
    // Create a new ticket
    $newTicket = $client->tickets()->create([
      'subject'  => $subject,
      'comment'  => [
          'body' => $comment
      ],
      'priority' => $priority
    ]);
    return $newTicket;
  }
  public static function deleteTicket($id) {
    $client = self::getClient();
    $client->tickets()->delete($id);
  }
  public static function updateTicket($id, $args=array()) {
    $client = self::getClient();
    // Update a ticket
    $client->tickets()->update($id,$args);
  }

}
