<?php

namespace App\Helpers;
use Config;
use Aws\Ec2\Ec2Client;
use Log;
use Aws\Credentials\Credentials;
final class AWSHelper {
  public static function reserveIP($region, $main, $privateIp) {
    $network = $main['network'];


    printf("using AWS info %s, %s", env('AWS_ACCESS_KEY'), env('AWS_SECRET_KEY'));
    $key = env('AWS_ACCESS_KEY');
    $secret = env('AWS_SECRET_KEY');
    $credentials = new Credentials($key, $secret);
    $ec2Client = new Ec2Client([
        'region' => $region,
        'version' => '2016-11-15',
        'credentials' => $credentials
    ]);
    $allocation = $ec2Client->allocateAddress(array(
        'DryRun' => false,
        'Domain' => 'vpc',
    ));

    $result = $ec2Client->associateAddress(array(
        'DryRun' => false,
        'NetworkInterfaceId' => $network,
        'AllocationId' => $allocation->get('AllocationId'),
        'PrivateIpAddress' => $privateIp

    ));
      return [
        'privateIp' => $privateIp,
        'publicIp' => $allocation->get('PublicIp')
       ];
  }
}

