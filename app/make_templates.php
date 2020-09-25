<?php

use App\Flow;
use App\FlowTemplate;
use App\FlowTemplatePreset;
use App\Helpers\MainHelper;
$forward = Flow::where('name','=', 'Call Forward Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $forward->flow_json,
  'name' => 'Call Forward',
  'description' => 'A basic example of call forwarding',
  'category' => 'Phone System'
]);


$options = [
  'Extension',
  'Phone Number',
];
FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'TypeOfCall',
  'screen_name' => 'Type Of Call',
  'description' => 'What type of call do you want to make',
  'variable_type' => 'basic',
  'data_type' => 'select',
  'extras' => $options,
  'default' => 'Phone Number'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'PhoneNumber',
  'screen_name' => 'Phone Number',
  'description' => 'The number to forward to',
  'variable_type' => 'basic',
  'data_type' => 'text',
  'default' => '',
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Extension',
  'screen_name' => 'Extesion',
  'description' => 'The extension to forward to',
  'depends_on_field' => 'TypeOfCall',
  'depends_on_value' => 'Extension',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'select'
]);


$ivr = Flow::where('name','=', 'Simple IVR Example Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $ivr->flow_json,
  'name' => 'Simple IVR',
  'description' => 'A setup for forwarding calls to 3 sections based on user selection',
  'category' => 'Phone System'
]);


$options = [
  'Extension',
  'Phone Number',
];
FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'TypeOfCall1',
  'screen_name' => 'Type Of Call 1',
  'description' => 'What type of call do you want to make',
  'variable_type' => 'basic',
  'data_type' => 'select',
  'extras' => $options,
  'default' => 'Phone Number'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'PhoneNumber1',
  'screen_name' => 'Phone Number 1',
  'description' => 'The number to forward to',
  'variable_type' => 'basic',
  'data_type' => 'text',
  'default' => '',
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Extension1',
  'screen_name' => 'Extension',
  'description' => 'The extension to forward to',
  'depends_on_field' => 'TypeOfCall1',
  'depends_on_value' => 'Extension',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'select'
]);



$options = [
  'Extension',
  'Phone Number',
];
FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'TypeOfCall2',
  'screen_name' => 'Type Of Call 2',
  'description' => 'What type of call do you want to make',
  'variable_type' => 'basic',
  'data_type' => 'select',
  'extras' => $options,
  'default' => 'Phone Number'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'PhoneNumber2',
  'screen_name' => 'Phone Number 2',
  'description' => 'The number to forward to',
  'variable_type' => 'basic',
  'data_type' => 'text',
  'default' => '',
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Extension2',
  'screen_name' => 'Extension 2',
  'description' => 'The extension to forward to',
  'depends_on_field' => 'TypeOfCall2',
  'depends_on_value' => 'Extension',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'select'
]);

$options = [
  'Extension',
  'Phone Number',
];
FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'TypeOfCall3',
  'screen_name' => 'Type Of Call 3',
  'description' => 'What type of call do you want to make',
  'variable_type' => 'basic',
  'data_type' => 'select',
  'extras' => $options,
  'default' => 'Phone Number'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'PhoneNumber3',
  'screen_name' => 'Phone Number 3',
  'description' => 'The number to forward to',
  'variable_type' => 'basic',
  'data_type' => 'text',
  'default' => '',
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Extension3',
  'screen_name' => 'Extension 3',
  'description' => 'The extension to forward to',
  'depends_on_field' => 'TypeOfCall3',
  'depends_on_value' => 'Extension',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'select'
]);

$voicemail = Flow::where('name','=', 'Voicemail Example Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $voicemail->flow_json,
  'name' => 'Voicemail Example',
  'description' => 'Forward calls to voicemail when there is a no answer dial status',
  'category' => 'Phone System'
]);


FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'ExtensionToCall',
  'screen_name' => 'Extension To Call',
  'description' => 'The extension to forward to',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'select'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Timeout',
  'screen_name' => 'Timeout',
  'description' => 'Call timeout',
  'variable_type' => 'basic',
  'data_type' => 'number',
  'default' => '30'
]);


$queue = Flow::where('name','=', 'Queue Example Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $queue->flow_json,
  'name' => 'Queue Example',
  'description' => 'Forward calls to voicemail when there is a no answer dial status',
  'category' => 'Phone System'
]);


FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Extensions',
  'screen_name' => 'Queue Extensions',
  'description' => 'Extensions in the queue',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'multi_select'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'MaxWaitTime',
  'screen_name' => 'Max Wait ime',
  'description' => 'Total time for caller to wait in queue',
  'variable_type' => 'basic',
  'data_type' => 'number',
  'default' => '60'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'MaxExtensionTimeout',
  'screen_name' => 'Max Extension Timeout',
  'description' => 'Total time call time per extension',
  'variable_type' => 'basic',
  'data_type' => 'number',
  'default' => '60'
]);



$transfer = Flow::where('name','=', 'Cold Transfer Template')->first();

$coldTransfer = <<<EOF
module.exports = function(event: LineEvent, context: LineContext) {
    return new Promise(async function(resolve, reject) {
        var sdk = context.getSDK();
        var channel = context.lineChannel;
        var flow = context.lineFlow;
 
        await channel.playTTS("Please enter the extension you want to transfer to");
        let exten = await channel.startAcceptingInput(3);
        var origBridge = channel.getBridge();
        var transferBridge = await sdk.createBridge();
        var call = await sdk.createCall(flow, exten, event['callerId'], 'Extension');
        call.on("Started", async function() {
            var allChannels = origBridge.channels;
            var filtered = allChannels.filter(function(targetChannel) {
                if ( targetChannel.channel.id !== channel.channel.id ) {
                    return true;
                }
                return false;
            });
            if (filtered.length <= 0) {
                reject("Other channel was not found cannot do call transfer..");
                return;
            }
            await transferBridge.addChannel(call.lineChannel);
            var otherChannel = filtered[0];
            otherChannel.automateCallHangup = false;
            await otherChannel.removeFromBridge();
            await transferBridge.addChannel(otherChannel);
            await origBridge.playTTS("Your call has been transfered");
            await channel.removeFromBridge();
            await channel.hangup();
        });
    });
}
EOF;

MainHelper::compileTypescript($coldTransfer, $output, $return);
$coldTransferCompiled= implode("\n", $output);
$extra_data = [
  'create' => [
      [
        'class' => 'MacroFunction',
        'args' => [
            'code' => $coldTransfer,
            'compiled_code' => $coldTransferCompiled,
            'title' => 'cold-transfer'
        ]
      ]
  ]
];

$template = FlowTemplate::create([
  'flow_json' => $transfer->flow_json,
  'name' => 'Cold Transfer',
  'description' => 'transfer calls to another extension',
  'category' => 'Extension Codes',
  'extra_data' => json_encode($extra_data)
]);

$voicemail = Flow::where('name','=', 'Check Voicemail Template')->first();

$code = <<<EOF
module.exports = function(event: LineEvent, context: LineContext) {
    return new Promise(async function(resolve, reject) {
        var sdk = context.getSDK();
        var channel = context.lineChannel;
        var flow = context.lineFlow;
     });
}
EOF;

MainHelper::compileTypescript($code, $output, $return);
$codeCompiled= implode("\n", $output);
$extra_data = [
  'create' => [
      [
        'class' => 'MacroFunction',
        'args' => [
            'code' => $code,
            'compiled_code' => $codeCompiled,
            'title' => 'check-voicemail'
        ]
      ]
  ]
];

$template = FlowTemplate::create([
  'flow_json' => $transfer->flow_json,
  'name' => 'Check Voicemail',
  'description' => 'check for voicemail',
  'category' => 'Extension Codes',
  'extra_data' => json_encode($extra_data)
]);



