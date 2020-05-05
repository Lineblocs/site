# Recordings And Voicemail

Recording voicemail is a simple yet very useful component of a phone system. 

In this guide we will go over how to create a workflow that allows your callers to record voicemail messages when you are unavailable. 

## Creating a voicemail flow

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter a name for your flow
3. use template "Voicemail Example"
4. Click "Create"

## Setup forwarding

The sample "Voicemail Example" flow is setup to forward to a extension and based on the receiving side not answering the call it will go to voicemail. 

In order for the voicemail recorder to work you will need to setup the "ForwardBridge", which lets you set the  extension to forward to before routing to voicemail. 

To edit your forwarding options please click the "ForwardBridge" widget, then edit the "Extension To Call" field.

![Basic IVR example](/img/frontend/docs/voicemail/ext-to-call.png)

## Setup recording options

Most voicemail recorders begin with a prompt and allow the caller to record a message until the caller either presses a terminating key, hangs up, or a noticable silence condition is met. 

To modify the options for your recording please click the "RecordingVoicemail" cell.

![record options](/img/frontend/docs/voicemail/record-options.png)

## Setup voicemail on a DID

To save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use the voicemail flow on a DID number:

1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. click "Save"


## Viewing Recordings

You can view a history of voicemail in your dashboard at any time. You can also sort or filter voicemails you've received in the past, as well as download the MP3 files. 

To view a history of your voicemail recordings please go to the [Recordings Page](http://app.lineblocs.com/#/recordings).

## Deleting Recordings

To delete recordings please click the "Delete" button next to the voicemail item in [Recordings Page](http://app.lineblocs.com/#/recordings).

## Next Steps

This guide went over recordings and voicemail. for related guides be sure to view the following:

[Call Forward](http://lineblocs.com/resources/quickstarts/call-forward)

[Setup Extension](http://lineblocs.com/resources/quickstarts/setup-extension)