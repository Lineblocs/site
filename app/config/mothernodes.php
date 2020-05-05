<?php

return [
  'containers_per_host' => 4,
  'regions' => [
    'ca-central-1' => [
      'proxy' => [
          'id' => 'proxy1',
          'privateIp' => '172.31.19.57',
          'publicIp' => '52.60.126.237'
      ],
      'options' => [
            [
              'privateIp' => '172.31.18.26',
              'publicIp' => '35.183.88.150',
              'network' => 'eni-0eec061e51a33c64d',
              'hosts' => [
                /*
                [
                    'privateIp' => '172.31.25.11',
                ],
                [
                    'privateIp' => '172.31.25.95',
                ],
                [
                    'privateIp' => '172.31.28.173',
                ],
                */
                [
                    'privateIp' =>'172.31.24.67',
                    'publicIp' => '35.183.165.223'
                ]
            ]
          ]
        ]
      ]
    ]
];
