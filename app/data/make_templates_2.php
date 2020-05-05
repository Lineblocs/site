<?php
use App\Flow;
use App\FlowTemplate;
use App\Helpers\MainHelper;


$voicemail = Flow::where('name','=', 'Check Voicemail Template')->firstOrFail();

$code = <<<EOF
async function playbackMessage(flow: LineFlow, channel: LineChannel, sdk: LineSDK, results: LineListResource < LineRecording > , recIndex: number) {

    console.log("playbackMessage called");
    if (recIndex === results.data.length) {
        // no more new messages
        return;
    }
    var recording = results.data[recIndex];
    console.log("calling playRecording on URL: " + recording.info.public_url);
    await sdk.playRecording(flow, channel, recording.info.public_url);
    console.log("calling playRecording");
    await recording.removeRecordingTag("unheard");
    let prompt = `To delete this message press 1. to go to the next message press 2`;
    let input = await channel.startAcceptingInput(5);
    if (input === "1") {
        await recording.deleteRecording();
        recIndex = recIndex + 1;
        playbackMessage(flow, channel, sdk, results, recIndex);
    } else if (input === "2") {
        recIndex = recIndex + 1;
        playbackMessage(flow, channel, sdk, results, recIndex);
    }
}

async function startAcceptingInput(sdk: LineSDK, flow: LineFlow, results: LineListResource < LineRecording > , channel: LineChannel) {


    return new Promise(async function (resolve, reject) {
        var text = `You have \${results.data.length} new messages to hear your unheard messages hit 1. to exit voicemail press *`;
        console.log("calling playTTS");
        await channel.playTTS(flow, text);
        console.log("calling startAcceptingInput");
        let input = await channel.startAcceptingInput(5);
        console.log(`user pressed \${input}`);
        if (input === "1") {
            await playbackMessage(flow, channel, sdk, results, 0);
        } else if (input === "*") {
            channel.hangup();
        } else {
            await channel.playTTS(flow, "sorry i could not understand that. please try again");
            await startAcceptingInput(sdk, flow, results, channel);
        }
    });
}
module.exports = function (event: LineEvent, context: LineContext) {
    return new Promise(async function (resolve, reject) {
        var sdk = context.getSDK();
        var flow = context.lineFlow;
        var channel = context.lineChannel;
        var session = await sdk.createSession(context.workspace.api_token, context.workspace.api_secret);
        var results = await session.listRecordings("unheard");
        await startAcceptingInput(sdk, flow, results, channel);
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
  'flow_json' => $voicemail->flow_json,
  'name' => 'Check Voicemail',
  'description' => 'check for voicemail',
  'category' => 'Extension Codes',
  'extra_data' => json_encode($extra_data)
]);


