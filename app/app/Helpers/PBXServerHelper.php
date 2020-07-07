<?php
namespace App\Helpers;
use \Config;
use \Log;
use \DB;
final class PBXServerHelper {
  public static function request($url, $body) 
  {
    $data_string = json_encode($body);                                                                                   
                                                                                                                         
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   
                                                                                                                         
    $result = curl_exec($ch);
  Log::info("server reply for $url is: " .$result);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  Log::info("server status code is: " . $httpcode);
    if ($httpcode >= 200 && $httpcode <= 299) {
      return $result;
    }
    return FALSE; 
  }
  public static function serverURL($ip, $endpoint) {
      return sprintf("http://%s:8080", $ip) . $endpoint;
  }

  public static function create($user,$workspace, $region, $proxyInfo, $hostInfo,  $reservedInfo="")
  {
    $url = self::serverURL($hostInfo['publicIp'], "/create");
    PBXServerHelper::addUserToProxy($user->toArray(), $workspace->toArray());
    $user->update([
      'ip_address' => $hostInfo['publicIp'],
       'ip_private' => $hostInfo['privateIp'],
      'reserved_ip' => '',
      'reserved_private_ip' => $reservedInfo['privateIp'],
      //'network_device' => $json['network_device'],
      //'sip_port' => $json['sipPort'],
      'sip_port' => '5060',
      //'rtp_ports' => implode(",", $json['rtpPorts']),
      'rtp_ports' => '',
      'region' => $region
    ]);
    return TRUE;
  }
  public static function modifyUser($user, $neededPorts=0)
  {
    $url = Config::get("pbxserver.server_url")."/modifyUser";

    $result =PBXServerHelper::request($url, [
      'user' => $user->toArray(),
      'request' => [
        'neededPorts' => $neededPorts
      ]
    ]);
    if ($result) {
      $json = json_decode($result, TRUE);
      $user->update([
        'rtp_ports' => implode(",", $json['rtpPorts'])
      ]);
      return TRUE;
    }
    return FALSE;
  }

   public static function provision($user, $workspace, $extensions) {
    $payload = array_map(function($item) {
      return ['user' => $item['username'], 'secret' => $item['secret'], 'caller_id' => $item['caller_id']];
    }, $extensions);
    PBXServerHelper::updateProxySIPUsers($user->toArray(), $workspace->toArray(), $payload);
    return TRUE;
  }
  public static function toDollars($cents) {
    return number_format(($cents /100), 2, '.', ' ');
  }
  public static function toCents($dollars) {
    $cents = \bcmul($dollars, 100);
    return  $cents;
  }

  public static function addUserToProxy($user, $workspace) {
    DB::connection('mysql-opensips')->insert('INSERT INTO `domain` (`domain`) VALUES (?)', [$workspace['domain']]);
  }
  public static function updateProxySIPUsers($user, $workspace, $extensions) 
  {
        $sipPort = $user['sip_port'];
        $pbxIP = $user['reserved_private_ip'] . ":" . $sipPort;
        $mainIP = $user['ip_private'];
        $domain = $workspace['domain'];
        $conn = DB::connection('mysql-opensips');
        $results = $conn->select('SELECT * FROM `subscriber` WHERE `domain` = ?', [$domain]);
        //$conn->enableQueryLog();
        foreach ($extensions as $extension) {
          $exists = FALSE;
          $user = $extension['user'];
          $secret = $extension['secret'];

          foreach ($results as $result) {
            if ($result->username == $extension['user']) {
                $exists = TRUE;
                $id = $result->id;
                $query = "UPDATE `subscriber` SET `username` = '%s',
                                        `password` = '%s',
                                        `ha1` = md5(concat('%s', ':', '%s', ':', '%s')),
                                        `ha1b` = md5(concat('%s', '@', '%s', ':', '%s', ':', '%s'))
                                        WHERE `id` = %s";
                $escaped = sprintf($query,
                    $user, 
                    $secret, 
                    $user,
                    $domain,
                    $secret,
                    $user,
                    $domain,
                    $domain,
                    $secret,
                    $id);

              $conn->update($escaped);
              break;
            }
         }
         if ($exists) {
            continue;
         }
         $query = "INSERT INTO subscriber (`username`,`domain`,`password`,`ha1`,`ha1b`) VALUES ('%s', '%s', '%s', md5(concat('%s', ':', '%s', ':', '%s')), md5(concat('%s', '@', '%s', ':', '%s', ':', '%s')))";
           $escaped = sprintf($query,
              $user,
              $domain,
              $secret,
              $user,
              $domain,
              $secret,
              $user,
              $domain,
              $domain,
              $secret);

          $result = $conn->insert($escaped);


         $query = "INSERT INTO `usr_preferences` (`username`, `domain`, `attribute`, `type`, `value`) VALUES ('%s', '%s', 'main_ip', '0', '%s')";
        $escaped = sprintf($query,
                $user,
                $domain,
                $pbxIP);

          $conn->insert($escaped);
      }
      // deleting
      foreach ($results as $result) {
        $found = FALSE;
        $id = $result->id;
        foreach ( $extensions as $extension ) {
            if ($result->username == $extension['user']) {
              $found = TRUE;
            }
        }
        if (!$found) {
          $query = "DELETE FROM `subscriber` WHERE `id` = '%s'";
          $escaped = sprintf($query, $id);
          $conn->delete($escaped);
          $query = "DELETE FROM `usr_preferences` WHERE `username` = '%s' AND `domain` = '%s'";
          $escaped = sprintf($query, $result->username, $domain);
          $conn->delete($escaped);
        }
      }
      //print_r($conn->getQueryLog());
        

        
              
  }

}
