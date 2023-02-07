<?php
namespace App\Helpers;

use App\Helpers\MainHelper;
use App\Classes\namecheap;
use Aws\Route53\Route53Client;
use Aws\Exception\CredentialsException;
use Aws\Route53\Exception\Route53Exception;

use App\SIPTrunk;
use App\SipTrunkTermination;
use App\Customizations;
use App\ApiCredential;
use App\DNSRecord;
use App\Classes\GoDaddyDDNS;
use Config;
use Exception;

final class DNSHelper {


  public static function refreshIPs() {

    $routerDNS = MainHelper::createDNSRecordsForRouters();
    $domain = env('DEPLOYMENT_DOMAIN');
    $sip_trunk_terminations = SIPTrunkTermination::all();
    $nc = array();
    $api_credentials = ApiCredential::getRecord();
    $customizations = Customizations::getRecord();
    $dns_provider = $customizations->dns_provider;
    $dns = Config::get("dns");
    $ingress = $dns['ingress'];
    $sandbox = FALSE;
    $baseEecordHosts = [
        '@',
        'app',
        'editor',
        'internals',
        'emailer',
        'tsc',
        's3fs',
        'prv',
        'mediafiles',
        'phpmyadmin'
    ];
    if ( $dns_provider == 'namecheap' ) {
      //$sandbox = $api_credentials->namecheap_sandbox;
      $sandbox = FAlSE;
      $namecheap = new namecheap([
          'api_user' => $api_credentials->namecheap_api_user,
          'api_key' => $api_credentials->namecheap_api_key,
          'api_ip' => $api_credentials->namecheap_api_ip
      ], $sandbox);

      $baseRecords = [];
      foreach ( $baseEecordHosts as $host ) {
        $baseRecords[] = [
              'host' => $host,
              'type' => 'A',
              'address' => $ingress,
              'ttl' => '60'
          ];
      }

      $dnsRecords = DNSRecord::all();
      foreach ( $dnsRecords as $record ) {
        $baseRecords[] = [
          'host' => $record['host'],
          'type' => $record['type'],
          'address' => $record['value'],
          'ttl' => (string) $record['ttl']
        ];
      }
      /*
      $baseRecords[] = [
        'host' => 's2._domainkey',
        'type' => 'CNAME',
        'address' => 's1.domainkey.u15410632.wl133.sendgrid.net',
        'ttl' => '60'
      ];
      $baseRecords[] = [
        'host' => 's2._domainkey',
        'type' => 'CNAME',
        'address' => 's2.domainkey.u15410632.wl133.sendgrid.net',
        'ttl' => '60'
      ];
      //stripe
      $baseRecords[] = [
        'host' => '@',
        'type' => 'TXT',
        'address' => 'stripe-verification=71dc1f640aaeefb3bc9505f74dda775a9fce272cecfb28be7fed09f378595b24',
        'ttl' => '60'
      ];
      $baseRecords[] = [
        'host' => 'r2a3yuadpxrvrih6nhw3pmt4yefgdld4._domainkey',
        'type' => 'CNAME',
        'address' => 'r2a3yuadpxrvrih6nhw3pmt4yefgdld4.dkim.custom-email-domain.stripe.com.',
        'ttl' => '60'
      ];
      $baseRecords[] = [
        'host' => 'skheiidgsmu2s2rwct5icpecr4ifxb6b._domainkey',
        'type' => 'CNAME',
        'address' => 'skheiidgsmu2s2rwct5icpecr4ifxb6b.dkim.custom-email-domain.stripe.com.',
        'ttl' => '60'
      ];
      $baseRecords[] = [
        'host' => 'mh6ykdbsuevixkfwgpnjhxhtfwpor564._domainkey',
        'type' => 'CNAME',
        'address' => 'mh6ykdbsuevixkfwgpnjhxhtfwpor564.dkim.custom-email-domain.stripe.com.',
        'ttl' => '60'
      ];
      $baseRecords[] = [
        'host' => '7zblwjnnhkw6ztakulywtnmptpaj7f3v._domainkey',
        'type' => 'CNAME',
        'address' => '7zblwjnnhkw6ztakulywtnmptpaj7f3v.dkim.custom-email-domain.stripe.com.',
        'ttl' => '60'
      ];
      $baseRecords[] = [
        'host' => 'ivngsvlfamxt5alua6kjkyldegacxh6b._domainkey',
        'type' => 'CNAME',
        'address' => 'ivngsvlfamxt5alua6kjkyldegacxh6b.dkim.custom-email-domain.stripe.com.',
        'ttl' => '60'
      ];
      $baseRecords[] = [
        'host' => 'ho7bkxahis6tiaqkpbctxjapeycp4xxz._domainkey',
        'type' => 'CNAME',
        'address' => 'ho7bkxahis6tiaqkpbctxjapeycp4xxz.dkim.custom-email-domain.stripe.com.',
        'ttl' => '60'
      ];
      $baseRecords[] = [
        'host' => 'bounce',
        'type' => 'CNAME',
        'address' => 'custom-email-domain.stripe.com.',
        'ttl' => '60'
      ];
      $baseRecords[] = [
        'host' => '@',
        'type' => 'TXT',
        'address' => 'google-site-verification=OdyUqonYof7cCbTWAPKJ4Wu-SvYxcfkMq9afhcP7rDs',
        'ttl' => '60'
      ];
      */

      foreach ($baseRecords as $cnt =>$info) {
        $number = $cnt + 1;
        $nc['HostName'.$number] =  $info['host'];
        $nc['RecordType'.$number] = $info['type'];
        $nc['Address'.$number] = $info['address'];
        $nc['TTL'.$number] = '60';

      }

      $increment = count($baseRecords) + 1;

      foreach ($routerDNS as $cnt => $info) {
        $user = $info['user'];
        $number = $cnt + $increment;
        //main PoP
        $nc['HostName'.$number] = $info['workspace']['name'];
        $nc['RecordType'.$number] = 'A';
        $nc['Address'.$number] = $router_ip;
        $nc['TTL'.$number] = '60';

        foreach ( $info['regions'] as $code => $region ) {
          // best way to make increment also increase ? look into better solution when possible
          $increment = $increment + 1;
          $number = $cnt + $increment;
          //region PoP
          $value = sprintf("%s.%s", $info['workspace']['name'], $region['internal_code']);
          $nc['HostName'.$number] = $value;
          $nc['RecordType'.$number] = 'A';
          $nc['Address'.$number] = $region['router_ip'];
          $nc['TTL'.$number] = '60';
        }
      }

      foreach ($sip_trunk_terminations as $cnt => $term_settings) {
        $host = MainHelper::createSIPTrunkTerminationURI( $term_settings->sip_addr );
        $number = $cnt + $increment;
        //main PoP
        $nc['HostName'.$number] = $host;
        $nc['RecordType'.$number] = 'A';
        $nc['Address'.$number] = $router_ip;
        $nc['TTL'.$number] = '60';
      }


      $result = $namecheap->dnsSetHosts($domain, $nc);
      if (!$result) {
        \Log::error( "NAMECHEAP error occured: " . $namecheap->Error);
        return FALSE;
      }
      return TRUE;
    } else if ( $dns_provider == 'route53' ) {
      // TODO implement
      //To build connection
      try {
          $access_key = $api_credentials['aws_access_key_id'];
          $secret_key = $api_credentials['aws_secret_access_key'];
          $region = $api_credentials['aws_region'];
          $client = Route53Client::factory(array(
              'region' => $region,
              'version' => '2013-04-01',
              'credentials' => [
                          'key' => $access_key,
                          'secret' => $secret_key,
                    ]
          ));
      } catch (Exception $e) {
              \Log::error('error initializing AWS client. ' . $e->getMessage());
              return FALSE;
      }

      /* Create sub domain */

      try {

          $HostedZoneId = $customizations->aws_route53_zone_id;
          $baseRecords = [];
          foreach ( $baseEecordHosts as $host ) {
            $baseRecords[] = [
                'Action'            => 'CREATE',
                "ResourceRecordSet" => [
                    'Name'            => $host,
                    'Type'            => 'A',
                    'TTL'             => '60',
                    'ResourceRecords' => [
                        array('Value' => $ingress)
                    ]
                ]
            ];
          }
          $dnsRecords = DNSRecord::all();
          foreach ( $dnsRecords as $record ) {
            $baseRecords[] = [
                'Action'            => 'CREATE',
                "ResourceRecordSet" => [
                    'Name'            => $record['host'],
                    'Type'            => $record['type'],
                    'TTL'             => (string) $record['ttl'],
                    'ResourceRecords' => [
                        array('Value' => $record['value'])
                    ]
                ]
            ];
          }

        foreach ($routerDNS as $cnt => $info) {
          $baseRecords[] = [
                'Action'            => 'CREATE',
                "ResourceRecordSet" => [
                    'Name'            => $info['workspace']['name'],
                    'Type'            => 'A',
                    'TTL'             => '60',
                    'ResourceRecords' => [
                        array('Value' => $info['proxy_ip'])
                    ]
                ]
            ];
          foreach ( $info['regions'] as $code => $region ) {
            //region PoP
            $value = sprintf("%s.%s", $info['workspace']['name'], $region['internal_code']);
            $baseRecords[] = [
                  'Action'            => 'CREATE',
                  "ResourceRecordSet" => [
                      'Name'            => $value,
                      'Type'            => 'A',
                      'TTL'             => '60',
                      'ResourceRecords' => [
                          array('Value' => $region['router_ip'])
                      ]
                  ]
              ];
          }
        }
      foreach ($sip_trunk_terminations as $cnt => $term_settings) {
        $host = MainHelper::createSIPTrunkTerminationURI( $term_settings->sip_addr );
        $baseRecords[] = [
              'Action'            => 'CREATE',
              "ResourceRecordSet" => [
                  'Name'            => $host,
                  'Type'            => 'A',
                  'TTL'             => '60',
                  'ResourceRecords' => [
                      array('Value' => $router_ip)
                  ]
              ]
          ];
      }

          $client->changeResourceRecordSets([
              'ChangeBatch'  => [
                  'Changes' => $baseRecords
              ],
              'HostedZoneId' => $HostedZoneId
          ]);
        } catch (Exception $ex) {
              \Log::error('error updating route53 records. ' . $ex->getMessage());
              return FALSE;
        }
      return TRUE;
    } else if ( $dns_provider == 'godaddy' ) {
        $update         =   array(
            //array( 'type' => 'A' , 'name' => '@' , 'ttl' => '3600' ) , 
            //array( 'type' => 'A' , 'name' => 'www' , 'ttl' => '3600' ) , 
        );
      $key = $api_credentials->godaddy_api_key;
      $secret = $api_credentials->godaddy_api_secret;
      $ddns = new GoDaddyDDNS( $domain, $key, $secret);

      foreach ( $baseRecords as $record ) {
        $update[] = [
          'type' => $record['type'],
          'name' => $record['host'],
          'ttl' => $record['ttl']
        ];
      }
      foreach ( $dnsRecords as $record ) {
        $update[] = [
          'type' => $record['type'],
          'name' => $record['host'],
          'ttl' => $record['ttl']
        ];
      }

      foreach ( $update as $record ) {
         $ddns->updateRecord( $record[ 'type' ] , $record[ 'name' ] , $external_ip , $record[ 'ttl' ] );
      }
    } else if ( $dns_provider == 'self-managed' ) {
      // TODO implement
      return TRUE;
    }
    return FALSE;
  }
}
