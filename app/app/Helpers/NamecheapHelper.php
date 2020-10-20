<?php

namespace App\Helpers;
use App\Helpers\MainHelper;
use App\Classes\namecheap;
use Config;
use Log;
final class NamecheapHelper {
  public static function refreshIPs() {
    $regions = MainHelper::getRegions();

    $data = MainHelper::reservedIPsForHost();
    $nc = array();
    $sld = "lineblocs";
    $tld = " com";
    $info = Config::get("namecheap");
    $dns = Config::get("dns");
    $ingress = $dns['ingress'];
    $sandbox = FALSE;
    $namecheap = new namecheap([
        'api_user' => $info['api_user'],
        'api_key' => $info['api_key'],
        'api_ip' => $info['api_ip'],
    ], $sandbox);

    $baseRecords = [
        [
          'host' => '@',
          'type' => 'A',
          'address' => $ingress,
          'ttl' => '60'
      ],

       [
          'host' => 'app',
          'type' => 'A',
          'address' => $ingress,
          'ttl' => '60'
      ],

       [
          'host' => 'editor',
          'type' => 'A',
          'address' => $ingress,
          'ttl' => '60'
      ],
       [
          'host' => 'emailer',
          'type' => 'A',
          'address' => $ingress,
          'ttl' => '60'
      ],
      [
          'host' => 'tsc',
          'type' => 'A',
          'address' => $ingress,
          'ttl' => '60'
      ],
      [
          'host' => 's3fs',
          'type' => 'A',
          'address' => $ingress,
          'ttl' => '60'
      ],

      [
          'host' => 'prv',
          'type' => 'A',
          'address' => $ingress,
          'ttl' => '60'
      ],

      [
          'host' => 'mediafiles',
          'type' => 'A',
          'address' => $ingress,
          'ttl' => '60'
      ],
      [
          'host' => 'phpmyadmin',
          'type' => 'A',
          'address' => $ingress,
          'ttl' => '60'
      ],
      [
          'host' => 'internals',
          'type' => 'A',
          'address' => $ingress,
          'ttl' => '60'
      ],
      [
          'host' => 'pbx',
          'type' => 'A',
          'address' => '155.138.159.234',
          'ttl' => '60'
      ]
    ];
    //sendgrid
    $baseRecords[] = [
      'host' => 'em8989',
      'type' => 'CNAME',
      'address' => 'u15410632.wl133.sendgrid.net',
      'ttl' => '60'
    ];
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

    foreach ($baseRecords as $cnt =>$info) {
      $number = $cnt + 1;
      $nc['HostName'.$number] =  $info['host'];
      $nc['RecordType'.$number] = $info['type'];
      $nc['Address'.$number] = $info['address'];
      $nc['TTL'.$number] = '60';

    }

    $increment = count($baseRecords) + 1;

    foreach ($data as $cnt => $info) {
      $user = $info['user'];
      $ip = $info['proxy_ip'];
      $number = $cnt + $increment;
      //main PoP
      $nc['HostName'.$number] = $info['workspace']['name'];
      $nc['RecordType'.$number] = 'A';
      $nc['Address'.$number] = $ip;
      $nc['TTL'.$number] = '60';

      foreach ( $regions as $code => $region ) {
        // best way to make increment also increase ? look into better solution when possible
        $increment = $increment + 1;
        $number = $cnt + $increment;
        //region PoP
        $value = sprintf("%s.%s", $info['workspace']['name'], $region['internal_code']);
        $nc['HostName'.$number] = $value;
        $nc['RecordType'.$number] = 'A';
        $nc['Address'.$number] = $region['proxy']['publicIp'];
        $nc['TTL'.$number] = '60';
      }
    }
    //echo var_dump($nc);
    $result = $namecheap->dnsSetHosts("lineblocs.com", $nc);
    if (!$result) {
      Log::error( "NAMECHEAP error occured: " . $namecheap->Error);
      return FALSE;
    }
    return TRUE;
  }
}
