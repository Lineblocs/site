<?php

return [
  'regions' => [
    'ca-central-1' => [
      'internal_code' => 'ca1',
      'name' => 'Canada Central',
      'proxy' => [
          'id' => 'proxy1',
          'privateIp' => '165.227.44.175',
          'publicIp' => '165.227.44.175'
      ],
      'options' => [
            [
              'privateIp' => '165.227.44.175',
              'publicIp' => '165.227.44.175',
              'network' => 'eni-0eec061e51a33c64d',
              'hosts' => [
                /*
                [
                    'privateIp' =>'172.31.24.67',
                    'publicIp' => '35.183.165.223'
                ]
                */
            ]
          ]
        ]
      ]
    ]
];
