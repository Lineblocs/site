<?php
namespace App\Helpers;
use \Config;
use \Log;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WebSvcHelper;
use App\SIPRouter;
use App\SIPProviderHost;

final class SIPRouterHelper {
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

  public static function updateProxyToEnableWorkspace($user,$workspace, $proxy) {
    SIPRouterHelper::addUserToProxy($user->toArray(), $workspace->toArray());
    return TRUE;
  }
  public static function modifyUser($user, $neededPorts=0)
  {
    $url = Config::get("pbxserver.server_url")."/modifyUser";

    $result =SIPRouterHelper::request($url, [
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
    SIPRouterHelper::updateProxySIPUsers($user->toArray(), $workspace->toArray(), $payload);
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
    $conn = DB::connection('mysql-opensips');
    self::addDomain($user, $workspace['domain']);
    //add all possible regions
    $regions = MainHelper::getRegions();
    //create domain per region
    foreach ( $regions as $region ) {
      $domain = MainHelper::makeDomainName($workspace['name'], $region['internal_code']);
      $conn->insert('INSERT INTO `domain` (`domain`) VALUES (?)', [$domain]);
    }
  }

  public static function addUACRegistrant($providerHost) {
    $conn = DB::connection('mysql-opensips');
    // e.g: 368391xxx:hTdTeeF3pHxX@ip.example.org
    $user = $providerHost->register_username;
    $password = $providerHost->register_password;
    $ipAddress = $providerHost->ip_address;
    $defaultRouter = SIPRouter::getMainRouter();
    $routerIP = $defaultRouter->ip_address;
    $registrationURI = sprintf("%s:%s@%s", $user, $password, $ipAddress);
    $aor = sprintf("%s:%s@%s", $user, $password, $ipAddress);

    // used in the Contact header for SIP
    $bindingURI = sprintf("%s@%s", $user, $routerIP);

    $conn->insert('INSERT INTO `registrant` (`registrar`, `aor`, `username`, `password`, `binding_URI`, `lineblocs_id`) VALUES (?, ?, ?, ?, ?, ?)', [$registrationURI, $user, $password, $aor, $bindingURI, $providerHost->id]);
  }

  public static function updateUACRegistrant($providerHost) {
    $conn = DB::connection('mysql-opensips');
    // e.g: 368391xxx:hTdTeeF3pHxX@ip.example.org
    $user = $providerHost->register_username;
    $password = $providerHost->register_password;
    $ipAddress = $providerHost->ip_address;
    $registrationURI = sprintf("%s:%s@%s", $user, $password, $ipAddress);
    $aor = sprintf("%s:%s@%s", $user, $password, $ipAddress);

    $defaultRouter = SIPRouter::getMainRouter();
    $routerIP = $defaultRouter->ip_address;
    // used in the Contact header for SIP
    $bindingURI = sprintf("%s@%s", $user, $routerIP);

    $conn->update('UPDATE `registrant` SET `registrar` = ?, `aor` = ?, `username` = ?, `password` = ?, `binding_URI` = ? WHERE `lineblocs_id` = ?', [$registrationURI, $user, $password, $aor, $bindingURI, $providerHost->id]);
  }
  public static function updateRouterIPs($defaultSIPRouter) {
    $conn = DB::connection('mysql-opensips');
    // e.g: 368391xxx:hTdTeeF3pHxX@ip.example.org
    $hosts = SIPProviderHost::all();
    $routerIP = $defaultSIPRouter->ip_address;
    foreach ( $hosts as $host ) {
      $bindingURI = sprintf("%s@%s", $host->user, $routerIP);
      $conn->update('UPDATE `registrant` SET `binding_URI` = ? WHERE `lineblocs_id` = ?', [$bindingURI, $host->id]);
    }
  }

  public static function deleteUACRegistrant($providerHost) {
    $conn = DB::connection('mysql-opensips');
    $conn->delete('DELETE FROM `registrant` WHERE `lineblocs_id` = ?', [$providerHost->id]);
  }

  public static function reloadRTPProxies() {
    // opensips-cli -x mi rtpproxy_reload
    $service = "opensips:1042";
    $path = "/reload_rtpproxies";
    $method ="get";
    $result = WebSvcHelper::request( $service, $path, $method );
    return $result;
  }

  public static function addDomain($user, $domain) {
    $conn = DB::connection('mysql-opensips');
    $conn->insert('INSERT INTO `domain` (`domain`) VALUES (?)', [$domain]);
  }

  public static function addRTPProxy($lineblocsId, $socketAddr) {
    $conn = DB::connection('mysql-opensips');
    $conn->insert('INSERT INTO `rtpproxy_sockets` (`rtpproxy_sock`, `lineblocs_id`) VALUES (?, ?)', [$socketAddr, $lineblocsId]);
    self::reloadRTPProxies();
  }

  public static function updateRTPProxy($lineblocsId, $socketAddr) {
    $conn = DB::connection('mysql-opensips');
    $conn->insert('UPDATE `rtpproxy_sockets`  SET rtpproxy_sock = ? WHERE `lineblocs_id` = ?', [$socketAddr, $lineblocsId]);
    self::reloadRTPProxies();
  }

  public static function removeRTPProxy($lineblocsId) {
    $conn = DB::connection('mysql-opensips');
    $conn->delete('DELETE FROM `rtpproxy_sockets` WHERE `lineblocs_id` = ?', [$lineblocsId]);
    self::reloadRTPProxies();
  }

  public static function removeDomain($user, $domain) {
    $conn = DB::connection('mysql-opensips');
    $conn->delete('DELETE FROM `domain` WHERE `domain` = ?', [$domain]);
  }




  public static function processSIPProxyDomain($user, $workspace, $domain, $extensions) 
  {
        $sipPort = $user['sip_port'];
        $pbxIP = $user['reserved_private_ip'] . ":" . $sipPort;
        $mainIP = $user['ip_private'];
        //$domain = $workspace['domain'];
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

  public static function updateProxySIPUsers($user, $workspace, $extensions) 
  {
    //main domain
    self::processSIPProxyDomain($user, $workspace, $workspace['domain'], $extensions);
    $regions = MainHelper::getRegions();
    //create user per region
    foreach ( $regions as $region ) {
      $domain = MainHelper::makeDomainName($workspace['name'], $region['internal_code']);
      self::processSIPProxyDomain($user, $workspace, $domain, $extensions);
    }
  }


  public static function removeAllUserData()
  {
    //main domain
    $conn = DB::connection('mysql-opensips');
    $conn->delete('DELETE FROM `subscriber`;');
    $conn->delete('DELETE FROM `domain`;');
    $conn->delete('DELETE FROM `rtpproxy_sockets`;');
    $conn->delete('DELETE FROM `usr_preferences`;');
  }

}
