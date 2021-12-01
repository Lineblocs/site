# Basic IVR

IVRs are very simple to the provision in Lineblocs. This guide will go over how to create a simple three-option IVR that allows your callers to choose which department they wish to route their call to.

## Requirements
You will need the following items to begin creating IVRs:

1. A DID Number
2. Lineblocs account
3. A non trial membership

## Creating an IVR

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter a name for your flow
3. use template "Simple IVR"
4. Click "Create"

## Editing the IVR auto attendant

By default, the Basic IVR template is configured with an auto-attendant, using the default settings. You may want to customize the auto attendant options based on your needs.

To update your IVR's auto attendant, please click the "ProcessInput" widget to bring up its sidebar options.

In the settings, you have the option to playback text-to-speech or a media file. You can also adjust settings like the maximum digits to gather or the terminating digit. 

If you need more info on any of these settings, you can hover over the info icon to the right of the field.

![process input](/img/frontend/docs/basic-ivr/process-input.png)

## Routing to departments

The Basic IVR template is set up to route to 3 bridges based on user input. Option 1 routing to Support, 2 routes to Sales, and 3 will route to an operator. 

If you want to change the default setup, you can update the "Links" tab in your "Switch" cell. To open the "Links" settings, please click the "Switch" cell then, click the "Links" tab.

## Editing the call bridges

In the Basic IVR example, we have set up 3 bridge widgets "SupportBridge," "SalesBridge," and "OperatorBridge." Each of these widgets forward to its extension.

To edit the extension these widgets forward to, please click the widget you want to update, then change the "Extension To Call" option.

![process input](/img/frontend/docs/basic-ivr/ext-to-call.png)

Your flow should now look similar to the following image:
![Basic IVR example](/img/frontend/docs/basic-ivr/main.png)

## Using the flow on a DID number

To save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use the IVR on one of your DIDs:

1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. Click "Save"

## Testing the flow

You should now be able to hear your IVR in action! When you call your DID number, your calls should be answered by your auto-attendant greeting as well as a route to your departments.

## Next Steps

In this guide, we went over how to set up an IVR. For other related guides, be sure to view the following:

[Recordings and Voicemail](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)

[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)