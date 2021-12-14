# Recordings And Voicemail

Recording voicemail is a simple yet beneficial component of a phone system. 

This guide will go over how to create a workflow that allows your callers to record voicemail messages when you are unavailable and play them when you are available. 


## Creating a voicemail flow

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter a name for your flow
3. Use template "Voicemail Example"
4. Click "Create"

## Setup forwarding

The sample "Voicemail Example" flow is set up to forward to an extension, and based on the receiving side; the call not being answered will redirect it to voicemail.

For the voicemail recorder to work, you will need to set up the "ForwardBridge," which will let you set the extension to forward to before routing to voicemail. 

To edit your forwarding options, please click the "ForwardBridge" widget, then edit the "Extension To Call" field.

![Basic IVR example](/img/frontend/docs/voicemail/ext-to-call.png)

## Setup recording options

Most voicemail recorders begin with a prompt and allow the caller to record a message until the caller either presses a terminating key, hangs up, or a noticeable silence condition is met. 

To modify the options for your recording, please click the "RecordingVoicemail" cell.

![record options](/img/frontend/docs/voicemail/record-options.png)

## Setup voicemail on a DID

To save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use the voicemail flow on a DID number:

1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. Click "Save"


## Viewing Recordings

You can view a history of voicemail in your dashboard at any time. You can also sort or filter voicemails received in the past, as well as download the MP3 files. 

To view a history of your voicemail recordings, please go to the [Recordings Page](https://app.lineblocs.com/#/recordings).

## Deleting Recordings

To delete recordings, please click the "Delete" button next to the voicemail item in [Recordings Page](https://app.lineblocs.com/#/recordings).

## Next Steps

This guide went over recordings and voicemail. For related guides be sure to view the following:

[Call Forward](https://lineblocs.com/resources/quickstarts/call-forward)

[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)