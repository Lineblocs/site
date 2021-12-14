# Call Screening

At a high level, call screenings allow your agents to accept calls based on various call-related details such as a Caller ID, calling department, and more. 

Basic call screenings can be used to avoid spam and notify agents of caller details. In more advanced cases you could use call screenings to allow your callers to record a greeting message or allow your agents to listen to a message being recorded on an answering machine.

In this guide we will setup a basic call screening that tells your agent what Caller ID an incoming call is coming from.

## Requirements

You will need the following to complete this tutorial:

1. a Lineblocs DID 
2. Extension

## Creating call whisper

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter a name for your flow
3. Select "Call Screening" template
4. Click "Create"

## Edit screening extension

to change the extension you want to forward call screenings to please click the "DialAgent" then update the "Extension To Call" option.

![Forward](/img/frontend/docs/screening/forward-opts.png)

## Change screening message

by default we play back a screening message that includes the Caller ID of the originating call.

if you want to update the default greeting, please click the "CallScreening" widget then edit the "Text To Say" field.

![Forward](/img/frontend/docs/screening/screen-opts.png)

## Using the flow on a DID number

to save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use your call flow on a DID Number:

1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. click "Save"

## Testing the flow

Your agents should now be able to screen calls as per your workflow. To test the call flow please call your DID number.

## Next Steps

in this guide we discussed setting up a simple call screening. for more advanced configurations please see guides below:

[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)

[Cold Transfer](https://lineblocs.com/resources/quickstarts/create-cold-transfer)