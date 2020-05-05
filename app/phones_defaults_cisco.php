<?php
use App\Helpers\PhoneProvisionHelper;
$data = [
  [
      'category' => 'Web',
      'options' => [
        [
            'name' => 'Enable_Web_Server',
             'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['Yes', 'No']
        ],
        [
            'name' => 'Web_Server_Port',
             'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '2'
        ],
        [
            'name' => 'Enable_Web_Admin_Access',
             'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['Yes', 'No']
        ],

        [
            'name' => 'Admin_Passwd',
             'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '2',
        ],
        [
            'name' => 'User_Password',
             'xml_attrs' => [
                'ua' => 'rw'
              ],
              'type' => '2',
        ]
      ]
  ],
  [
      'category' => 'Network',
// Network
       'options' => [
          [
            'name' => 'Connection_Type',
            'xml_attrs' => [
                'ua' => 'rw'
              ],
              'type' => '1',
              'options' => ['DHCP']
        ],
        [
            'name' => 'Use_Backup_IP',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['Yes', 'No']
        ],
        [
            'name' => 'Static_IP',
            'xml_attrs' => [
                'ua' => 'rw'
              ],
              'type' => '2'
        ],
         [
            'name' => 'NetMask',
            'xml_attrs' => [
                'ua' => 'rw'
              ],
              'type' => '2'
        ],
        [
            'name' => 'Gateway',
            'xml_attrs' => [
                'ua' => 'rw'
              ],
              'type' => '2'
        ],
        [
            'name' => 'HostName',
            'xml_attrs' => [
                'ua' => 'rw'
              ],
              'type' => '2'
        ],

          [
            'name' => 'Domain',
            'xml_attrs' => [
                'ua' => 'rw'
              ],
              'type' => '2'
        ],
        [
            'name' => 'Enable_SSLv3',
            'xml_attrs' => [
                'ua' => 'rw'
              ],
              'type' => '1',
              'options' => ['Yes', 'No']
        ],
      ]
  ],
  [
      'category' => 'VLAN',
      'options' => [
      
// VLAN
           [
            'name' => 'Enable_VLAN',
              'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['Yes', 'No']
          ],
          [
            'name' => 'VLAN_ID ',
              'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['1']
          ],
          [
            'name' => 'PC_Port_VLAN_Highest_Priority',
              'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['No Limit']
          ],
        [
            'name' => 'Enable_PC_Port_VLAN_Tagging',
              'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['No']
          ],
        [
            'name' => 'PC_Port_VLAN_ID',
              'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['1']
          ]
    ]
  ],
  [
      'category' => 'CDP and LLDP-MED',
      'options' => [
          [
            'name' => 'Enable_CDP',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['No', 'Yes']
        ],
         [
            'name' => 'Enable_LLDP-MED',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['No', 'Yes']
        ]
        ]
  ],
  [
      'category' => 'NTP',
      'options' => [
           [
            'name' => 'NTP_Enable',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['No', 'Yes']
        ],

      [
            'name' => 'Primary_NTP_Server',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '2'
        ],

      [
            'name' => 'Secondary_NTP_Server',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '2'
        ]
    ]
  ],
  [
      'category' => 'SysLog',
      'options' => [
      [
            'name' => 'Syslog_Server',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '2'
        ],
[
            'name' => 'Debug_Server',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '2'
        ],
[
            'name' => 'Debug_Level',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
            'options' => ['0']
        ],
      [
            'name' => 'Layer_2_Logging',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
            'options' => ['No', 'Yes']
        ],
    ]
  ],
    [
        'category' => 'SIP',
        'options' => [
          [
            'name' => 'SIP_Reg_User_Agent_Name',
          'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '2'
        ],
         [
            'name' => 'Reg_Retry_Intvl',
          'xml_attrs' => [
                'group' => 'SIP/SIP_Timer_Values__sec_'
              ],
              'type' => '2'
        ],
          [
            'name' => 'Reg_Retry_Long_Intvl',
          'xml_attrs' => [
                'group' => 'SIP/SIP_Timer_Values__sec_',
              ],
              'type' => '2'
        ]
    ]
    ],
    [
      'category' => 'EXT1-12',
      'options' => [
            [
              'name' => 'Line_Enable_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],

            [
              'name' => 'Line_Enable_2_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
          [
              'name' => 'Line_Enable_3_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
          [
              'name' => 'Line_Enable_4_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
          [
              'name' => 'Line_Enable_5_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
          [
              'name' => 'Line_Enable_6_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
          [
              'name' => 'Line_Enable_7_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
            [
              'name' => 'Line_Enable_8_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
          [
              'name' => 'Line_Enable_9_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
          [
              'name' => 'Line_Enable_10_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
          [
              'name' => 'Line_Enable_11_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
          [
              'name' => 'Line_Enable_12_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
      ]
    ],
    [
      'category' => 'Network',
      'options' => [
          [
            'name' => 'Proxy_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2'
          ],
          [
            'name' => 'SIP_Port_1',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2'
          ],
          [
            'name' => 'SIP_Transport_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],


[
            'name' => 'Register_Expires_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2'
          ],
[
            'name' => 'Auto_Register_When_Failover_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
[
            'name' => 'NAT_Keep_Alive_Enable_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],

[
            'name' => 'NAT_Keep_Alive_Msg_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2'
          ],
[
            'name' => 'NAT_Keep_Alive_Dest_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2'
          ],

[
            'name' => 'SIP_TOS_DiffServ_Value_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
                'default' => '0x68'
          ],

[
            'name' => 'SIP_CoS_Value_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['3']
          ],
[
            'name' => 'RTP_TOS_DiffServ_Value_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
                'default' => '0xb8'
          ],
[
            'name' => 'Network_Jitter_Level_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['high']
          ],
[
            'name' => 'Jitter_Buffer_Adjustment_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['up and down']
          ],
      ]
    ],
    [
      'category' => 'Auth',
      'options' => [
        [
            'name' => 'User_ID_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2'
      ],
       [
            'name' => 'Password_1_',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2'
      ],
    ]
    ],
    [
      'category' => 'Settings',
      'options' => [
          [
            'name' => 'Default_Ring__1__',
             'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No Ring']
        ],
        [
            'name' => 'Dial_Plan_1_',
             'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
              'default' => '(9xxxxxxxxxS0|8xxxxxxxxxxS0|7xxxxxxxxxxS0|xxxxxxxxxx)'
        ]

      ]
   ],
   [
      'category' => 'Codecs',
      'options' => [
          [
               'name' => 'G711u_Enable_1_',
                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
        ],
            [
               'name' => 'G729a_Enable_1_',

                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
        ],
        [
               'name' => 'G723_Enable_1_',

                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
        ],
        [
               'name' => 'G722_Enable_1_',

                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
        ],
        [
               'name' => 'L16_Enable_1_',

                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
        ],
[
               'name' => 'AMR-W8_Enable_1_',

                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
        ],
[
               'name' => 'G726-16_Enable_1_',

                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
        ],
[
               'name' => 'G726-24_Enable_1_',

                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
        ],
[
               'name' => 'G726-32_Enable_1_',

                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
        ],
[
               'name' => 'G726-48_Enable_1_',

                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
        ],
[
               'name' => 'Preferred_Codec_1_',


                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['G711a']
        ],
[
               'name' => 'Second_Preferred_Codec_1_',
                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['G711u']
        ],
[
               'name' => 'Third_Preferred_Codec_1_',


                 'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['Unspecified']
        ]
    ]
  ],
  [
      'category' => 'Provision',
      'options' => [
          [
              'name' => 'Provision_Enable',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
          ],
      [
              'name' => 'DHCP_Option_To_Use',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
              'default' => '66,160,159,150,60,43,125'
          ],
//$upgrade_rule_SPA50x_30x = '( $SWVER lt 7.5.2b )? http://cisco.company.local/cisco/firmware/spa50x-30x-7-5-2b.bin | http://cisco.company.local/cisco/firmware/spa50x-30x-7-6-2.bin';
//$upgrade_rule_SPA51x = 'http://cisco.company.local/cisco/firmware/spa51x-7-6-2.bin';

      [
              'name' => 'Upgrade_Rule',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
              'default' => '( $SWVER lt 7.5.2b )? http://cisco.company.local/cisco/firmware/spa50x-30x-7-5-2b.bin | http://cisco.company.local/cisco/firmware/spa50x-30x-7-6-2.bin'
          ],
[
              'name' => 'Profile_Rule',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
          ],
[
              'name' => 'Profile_Rule_B',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
          ],
[
              'name' => 'Profile_Rule_C',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
          ],
[
      'name' => 'Profile_Rule_D',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
          ],

          [
      'name' => 'Resync_On_Reset',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
              'options' => ['No', 'Yes']
          ],
          [
      'name' => 'Resync_Periodic',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
                'default' => '3600'
          ],
          [
      'name' => 'Forced_Resync_Delay ',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
                'default' => '1800'

          ],
     [
      'name' => 'Resync_Fails_On_FNF',
              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '1',
                'options' => ['No', 'Yes']
          ],
     [
      'name' => 'Resync_Error_Retry_Delay',

              'xml_attrs' => [
                  'ua' => 'na'
                ],
                'type' => '2',
                'default' => '60'
          ],
   ]
  ],
  [
      'category' => 'Regional',
      'options' => [
          [
            'name' => 'Dictionary_Server_Script',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
            'type' => '2', 
            'default' => 'serv=http://cisco.company.local/cisco/dict/;d0=English;x0=spa50x_30x_en_v756.xml;d1=Russian;x1=spa50x_30x_ru_v756.xml;'
        ],
        [
            'name' => 'Language_Selection',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
            'type' => '1', 
                'options' => ['English']
        ],
        [
            'name' => 'Locale',
            'xml_attrs' => [
                  'ua' => 'na'
                ],
            'type' => '1', 
                'options' => ['en-US']
        ]
      ]
  ],
  [
      'category' => 'Supplementary Services',
      'options' => [
[
    'name' => 'Conference_Serv',
    'type' => '2'
],
[
  'name' => 'Attn_Transfer_Serv',
    'type' => '2'
],
[
  'name' => 'Blind_Transfer_Serv',
    'type' => '2'
],
[
  'name' => 'DND_Serv',
    'type' => '2'
],
[
  'name' => 'Block_ANC_Serv',
    'type' => '2'
],
[
  'name' => 'Call_Back_Serv',
    'type' => '2'
],
[
  'name' => 'Block_CID_Serv',
  'type' => '2'
],
[
  'name' => 'Secure_Call_Serv',
  'type' => '2'
],
[
  'name' => 'Cfwd_All_Serv',
  'type' => '2'
],
[
  'name' => 'Cfwd_Busy_Serv',
  'type' => '2'
],
[
  'name' => 'Cfwd_No_Ans_Serv',
  'type' => '2'
],
[
  'name' => 'Paging_Serv',
  'type' => '2'
],
[
  'name' => 'Call_Park_Serv',
  'type' => '2'
],
[
  'name' => 'Call_Pick_Up_Serv',
  'type' => '2'
],
[
  'name' => 'ACD_Login_Serv',
  'type' => '2'
],
  [
'name' => 'Group_Call_Pick_Up_Serv',
  'type' => '2'
],
[
  'name' => 'ACD_Ext',
  'type' => '2'
],
[
  'name' => 'Service_Annc_Serv',
  'type' => '2'
]
    ]
],
  [
      'category' => 'Time',
      'options' => [
        [
            'name' => 'Time_Zone',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['GMT']
        ],
        [
            'name' => 'Ignore_DHCP_Time_Offset',
            'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['No', 'Yes']
        ]
    ]
    ],
    [
      'category' => 'Phone',
      'options' => [
[
  'name' => 'Extension_1_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_1_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],
[
  'name' => 'Extension_2_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_2_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],

[
  'name' => 'Extension_3_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_3_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],


[
  'name' => 'Extension_4_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_4_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],


[
  'name' => 'Extension_5_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_5_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],

[
  'name' => 'Extension_6_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_6_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],

[
  'name' => 'Extension_7_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_7_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],

[
  'name' => 'Extension_8_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_8_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],

[
  'name' => 'Extension_9_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_9_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],

[
  'name' => 'Extension_10_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_10_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],

[
  'name' => 'Extension_11_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_11_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],


[
  'name' => 'Extension_12_',
  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '1',
        'options' => ['Enabled', 'Disabled']
],
[
  'name' => 'Short_Name_12_',

  'xml_attrs' => [
          'ua' => 'na'
        ],
        'type' => '2'
],

    ],
],
  [
    'category' => 'Logo',
      'options' => [
          [
          'name' => 'Text_Logo',
          'type' => '2'
         ],
          [
          'name' => 'Select_Background_Picture',
          'type' => '1',
          'options' => ['Text Logo']
         ],
          [
          'name' => 'Softkey_Labels_Font',
          'type' => '1',
          'options' => ['Auto']
         ],
        [
          'name' => 'Screen_Saver_Enable',
          'type' => '1',
          'options' => ['No']
         ]
    ]
  ],
  [
    'category' => 'LDAP',
    'options' => [
[
  'name' => 'LDAP_Dir_Enable',
    'type' => '1',
          'options' => ['No', 'Yes']
],
[
  'name' => 'LDAP_Corp_Dir_Name',
  'type' => '2'
],
[
  'name' => 'LDAP_Server',
  'type' => '2'
],
[
  'name' => 'LDAP_Auth_Method',
  'type' => '1',
          'options' => ['Simple']
],
[
  'name' => 'LDAP_Client_DN',
  'type' => '2'
],
[
  'name' => 'LDAP_Username',
  'type' => '2'
],
[
  'name' => 'LDAP_Password',
  'type' => '2'
],
[
  'name' => 'LDAP_Search_Base',
  'type' => '2'
],
[
  'name' => 'LDAP_Last_Name_Filter',
  'type' => '2'
],
[
  'name' => 'LDAP_First_Name_Filter',
  'type' => '2'
],
[
  'name' => 'LDAP_Search_Item_3',
  'type' => '2'
],
[
  'name' => 'LDAP_Item_3_Filter',
  'type' => '2'
],
[
  'name' => 'LDAP_Search_Item_4',
  'type' => '2'
],
[
  'name' => 'LDAP_item_4_Filter',
  'type' => '2'
],
[
  'name' => 'LDAP_Display_Attrs',
  'type' => '2'
],
[
  'name' => 'LDAP_Number_Mapping',
  'type' => '2'
]
    ]
  ],
  [
      'category' => 'User',
      'options' => [
[
  'name' => 'Speed_Dial_3',
    'type' => '2'
],
[
  'name' => 'Speed_Dial_4',
    'type' => '2'
],
[
  'name' => 'Speed_Dial_5',
    'type' => '2'
],
[
  'name' => 'Speed_Dial_6',
    'type' => '2'
],
[
  'name' => 'Speed_Dial_7',
    'type' => '2'
],
[
  'name' => 'Speed_Dial_8',
    'type' => '2'
],
[
  'name' => 'Speed_Dial_9',
    'type' => '2'
]
  ]
  ],
  [
    'category' => 'Call Waiting',
    'options' => [
          [
            'name' => 'CW_Setting',
             'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['Yes', 'No']
        ],
          [
            'name' => 'Preferred_Audio_Device',
             'xml_attrs' => [
                'ua' => 'na'
              ],
              'type' => '1',
              'options' => ['Headset']
        ]
    ]
  ],
  [
      'category' => 'Time',
      'options' => [
        [
          'name' => 'Time_Format',
          'type' => '1',
              'options' => ['24hr']
        ],
        [
          'name' => 'Date_Format',
          'type' => '1',
              'options' => ['day/month']
        ]
    ]
  ],
  [
      'category' => 'LCD',
      'options' => [
        [
          'name' => 'LCD',
          'type' => '1',
              'options' => ['5']
        ],
        [
          'name' => 'Back_Light_Timer',
          'type' => '1',
              'options' => ['20 s']
        ]
    ]
  ]
];
PhoneProvisionHelper::importDefaults($data, ['7', '8', '9', '10']);

