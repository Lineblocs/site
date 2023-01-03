<?php
use App\Flow;
use App\FlowTemplate;
use App\CallSystemTemplate;
use App\Helpers\MainHelper;

$flows = [
/*
          [
            'name' => 'Simple IVR',
            'template' => 'Simple IVR'
          ],
          [
            'name' => 'Call Forward',
            'template' => 'Call Forward'
          ]
          */
       ];


        $extensions = [
          [
            'username' => '1000',
            'caller_id' => '1000',
            'flow_name' => 'Call Forward'
          ],
          [
            'username' => '2000',
            'caller_id' => '2000',
            'flow_name' => 'Call Forward'
          ]
        ];
        $codes = [
        ];        
        $template = array(
          "extensions" => $extensions,
          "extension_codes" => $codes,
          "flows" => $flows
        );
        CallSystemTemplate::create([
          'name' => 'Basic Call System',
          'description' => 'Includes 2 extensions, call forwarding and a simple IVR setup',
          'data' => json_encode($template)
        ]);

