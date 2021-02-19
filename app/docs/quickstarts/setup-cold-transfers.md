# Setup Cold Transfers

![Setup cold transfers](/img/frontend/docs/macros/business-hours.png)

Lineblocs macros allow you to add custom functionality to your flow. Basic macros can be created based on a template and customized using the TypeScript language. 

Some examples of where you may want to use macros includes sending a lead to a CRM like salesforce, sending out an email using an API, or doing some other internal tasks.

In this example we will setup a flow that only forwards a call to an agent during business hours.

## Getting Started

1. Login to your Lineblocs account at [app.linelocs.com/#/login](https://app.lineblocs.com/#/login)
2. click "Settings" in the left menu
3. click "Workspace Params"

## Adding A Parameter

We will add a workspace param so that we know which timezone we need to use to check for our agent's availability. 

To add a timezone workspace param please click "Add Param". in the key field use "timezone" then use any valid timezone name in the value field. for example "America/Toronto". 

To see a full list of timezones please use [this link](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones).

Your workspace params screen should now look like the following image:
![Workspace Params](/img/frontend/docs/macros/workspace-params.png)

When you are done please click "Save"

## Creating the flow

To create a new lineblocs flow based on your timezone availability:

1. Login to your Lineblocs account at [app.linelocs.com/#/login](https://app.lineblocs.com/#/login)
2. click "Create" button on the top right
3. click "New Flow"
4. enter name "Business Hours Check"
5. select example template "Call Forward"

![flow select](/img/frontend/docs/macros/flow-select.png)

## Adding a Macro

To add a new macro please drag the "Macro" widget from the right pane into the flow graph.

![Macro](/img/frontend/docs/macros/macro.png)

## Example Flow With Macro

![Macro Added](/img/frontend/docs/macros/macro-added.png)

## Updating Macro

To add custom code to our macro please click the "Macro" widget and then click "Create Function" in the right pane.

![Macro Added](/img/frontend/docs/macros/create-function.png)

In the template selection screen choose template "Hours Check"
![Hours Template](/img/frontend/docs/macros/hours-template.png)

![Flow Editor](/img/frontend/docs/macros/save-macro.png)

## Add Playback widget

We will also need to add a closed message widget so that we can play a message when our time condition is not satisfied. To add a playback widget for when your office is closed, please drag a "Playback" widget from the right pane into the flow editor, and use the following settings on this widget.

![Closed Playback](/img/frontend/docs/macros/closed-playback.png)

```
Widget Name: ClosedMessagePlayback
```

```
Playback Type: Say
```

```
Text To Say: Our office is currently closed please call us again during monday to friday 9AM to 5PM eastern time.
```

```
Language: en-US
```

```
Gender: FEMALE
```

```
Voice: en-US-Standard-C
```


## Adding a Switch widget

We will add a "Switch" widget so that we can test for our time condition and go to the correct widget. 

To add a "Switch" widget please drag a new "Switch" widget into the flow graph. rename this widget into "HoursSwitch" then change the "Variable to test" to Macro.result.

![Select Macro](/img/frontend/docs/macros/switch-widget-options.png)

## Updating Switch Links

Please go to the "Links" tab of the "HoursSwitch" widget and add the following 2 links

### Link 1

```
Condition: Equals
```

```
Value: open
```

```
Cell to link: ForwardBridge
```

### Link 2

```
Condition: Equals
```

```
Value: closed
```

```
Cell to link: ClosedMessagePlayback
```

The "HoursSwitch" link section should now look like the following:
![Select Macro](/img/frontend/docs/macros/switch-links.png)

## Connecting Flow Links

Next we will need to update the flow to use our widgets.

To make adjustments to your flow so that all of the widgets are working correctly you will need to connect "Incoming Call" port from the Launch widget into the Macro's "In" port and add a link from widget Macro's "Completed" port into the HoursSwitch's "In" port.

Below is an example of how the final flow should look like:
![Select Macro](/img/frontend/docs/macros/flow-updated.png)

## Using the flow on a DID number

To save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use your call flow on a DID Number:

1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. click "Save"

## Testing the flow

You should be able to call your number and see your business hours check working. Your callers will hear a message when you are unavailable and they will be forwarded to you during your business hours.

## Next Steps

In this guide we discussed setting up macros on lineblocs. For other related quickstart posts be sure to check out:

[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)

[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)