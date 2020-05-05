<?php

use App\Flow;
use App\FlowTemplate;
use App\Helpers\MainHelper;
$forward = Flow::where('name','=', 'Call Forward Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $forward->flow_json,
  'name' => 'Call Forward',
  'description' => 'A basic example of call forwarding',
  'category' => 'Phone System'
]);
$ivr = Flow::where('name','=', 'Simple IVR Example Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $ivr->flow_json,
  'name' => 'Simple IVR',
  'description' => 'A setup for forwarding calls to 3 sections based on user selection',
  'category' => 'Phone System'
]);
$voicemail = Flow::where('name','=', 'Voicemail Example Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $voicemail->flow_json,
  'name' => 'Voicemail Example',
  'description' => 'Forward calls to voicemail when there is a no answer dial status',
  'category' => 'Phone System'
]);
$voicemail = Flow::where('name','=', 'Queue Example Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $voicemail->flow_json,
  'name' => 'Queue Example',
  'description' => 'Forward calls to voicemail when there is a no answer dial status',
  'category' => 'Phone System'
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



