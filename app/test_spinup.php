<?php
//require_once('./vendor/autoload.php');
use \App\User;
use \App\Workspace;
//use \Config;
use \App\Helpers\PBXServerHelper;
use \App\Helpers\MainHelper;
use \App\Helpers\NamecheapHelper;
       //$user = User::findOrFail(139);
        $username =   'yes-new-4';
        $user = MainHelper::createUser([
          'first_name' => 'Test',
          'last_name' => '1234',
          'email' => $username . '@infinitet3ch.com',
          'password' => 'test18',
          'sip_port' => '5060',
          'rtp_ports' => ''
        ]);
        $user->update([
            'confirmed' => 1,
            'reserved_ip' => '172.31.18.26',
            'container_name' => $username
        ]);
        $workspace = Workspace::create([
          'name' => $username,
          'creator_id' => $user->id
        ]);

        $plans = Config::get("service_plans");

        $trial = $plans['trial'];
        $region = "ca-central-1";
        if ($user->confirmed) {
          $info = MainHelper::getHostIPForUser($region, $user);
          //$reservedIp = AWSHelper::reserveIP($region, $ip['main'], $ip['reservedIp']);
          //$reservedIp = VultrHelper::reserveIP($region, $ip['main'], $ip."/32");
          /*
          if (!$reservedIp) {
            return $this->response->errorInternal('could not register IP for user');
          }
          */

          $result = PBXServerHelper::create($user, $workspace, $region, $info['proxy'], $info['main'], $info['reservedInfo'], $trial['ports']/** needed ports **/);
          NamecheapHelper::refreshIPS();
      }

