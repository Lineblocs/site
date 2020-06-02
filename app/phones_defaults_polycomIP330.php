<?php
use App\Helpers\PhoneProvisionHelper;
$data = [
  [
      'category' => 'Server Info',
      'options' => [
        [
            'variable_name' => 'address',
            'name' => 'Address',
            'type' => '2'
        ],
        [
            'variable_name' => 'expires',
            'name' => 'Expires',
            'type' => '2'
        ],
        [
            'variable_name' => 'transport',
            'name' => 'Transport',
            'type' => '1',
            'options' => ['UDPOnly']
        ],

      ]
  ],
  [
      'category' => 'Reg Info',
      'options' => [
        [
            'variable_name' => 'displayName',
            'name' => 'Display Name',
            'type' => '2'
        ],
        [
            'variable_name' => 'address',
            'name' => 'Address',
            'type' => '2'
        ],
        [
            'variable_name' => 'type',
            'name' => 'Type',
            'type' => '1',
            'options' => ['private']
        ],
        [
            'variable_name' => 'auth.userId',
            'name' => 'UserID',
            'type' => '2'
        ],
        [
            'variable_name' => 'auth.password',
            'name' => 'Password',
            'type' => '2'
        ],
        [
            'variable_name' => 'label',
            'name' => 'Label',
            'type' => '2'
        ],
        [
            'variable_name' => 'server.1.register',
            'name' => 'Server 1 Register',
            'type' => '1',
            'options' => ['0', '1']
        ],
        [
            'variable_name' => 'server.1.address',
            'name' => 'Server 1 Address',
            'type' => '2'
        ],

        [
            'variable_name' => 'server.1.port',
            'name' => 'Server 1 Port',
            'type' => '2'
        ],
        [
            'variable_name' => 'server.1.expires',
            'name' => 'Server 1 Expires',
            'type' => '2'
        ],
        [
            'variable_name' => 'server.1.transport',
            'name' => 'Server 1 Transport',
          'type' => '1',
            'options' => ['UDPOnly']

        ]
      ]
   ],
  [
    'category' => 'TCP IP App',
      'options' => [
        [
            'variable_name' => 'sntp.address',
            'name' => 'SNTP Address',
            'type' => '2'
        ],
        [
            'variable_name' => 'sntp.gmtOffset',
            'name' => 'SNTP GMT Offset',
            'type' => '2'
        ]
      ]
  ]

];
PhoneProvisionHelper::importDefaults($data, ['11', '12']);

