<?php
namespace App\Helpers;
final class WebSvcHelper {
  public static function request( $service, $path, $method, $params = array())
  {
    $url = sprintf("http://%s%s", $service, $path);
    if ( $method == 'GET' ) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close( $ch );
        if ( $httpcode >= 200 && $httpcode <= 299) {
          return $result;
        }
        return FALSE;
    } else if ( $method == 'POST' ) {
        $data_string = http_build_query($params);
                                                                                                                            
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Length: ' . strlen($data_string))
        );                                                                                                                   
                                                                                                                        
        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close( $ch );
        if ( $httpcode >= 200 && $httpcode <= 299) {
          return $result;
        }
        return FALSE;
    }
  }
  public static function post( $service, $path, $params = array())
  {
    return WebSvcHelper::request( $service, $path, "POST", $params );
  }
}
