# Call Forwarding

Lineblocs editors allow you to create call flows for basic and advanced call forwarding needs.

This guide will show you how to forward a call to a external phone number using the Lineblocs flow editor.

## Requirements

You will need the following to start forwarding calls using lineblocs:

1. a DID Number
2. Lineblocs account

## Creating call forward

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter a name for your flow
3. Select "Call Forward" template
4. Click "Create"

## Edit call forwarding number

To change the number you want to forward to please click the "ForwardBridge" then update the "Number To Call" option.

![Forward](/img/frontend/docs/forward/forward-opts.png)

## Change Caller ID

By default the caller ID will show the caller's caller ID. If you want to use a custom caller ID instead you can change the "Caller ID" option.

![Caller ID](/img/frontend/docs/forward/caller-id.png)

## Record Forwarded Calls

To record your forwarded calls please check the "Do Record" option.

![do record](/img/frontend/docs/pinless-conference/do-record.png)

## Using the flow on a DID number

To save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use your call flow on a DID Number:

1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. click "Save"

## Testing the flow

Your calls should be now forwarded to the number you specified along with the Caller ID you set.

## Next Steps

In this guide we discussed setting up a simple call forward. for more advanced configurations please see guides below:

[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)

[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)