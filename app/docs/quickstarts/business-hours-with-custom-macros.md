# Business Hours Check using Macros

![Call Queues example](/img/frontend/docs/macros/business-hours.png)

Lineblocs macros allow you to add custom functionality to your call flows, using the TypeScript language. 

Using Lineblocs macros, you can create high level integrations that include tasks such as sending a lead to a CRM, or sending out an email using an API.

In this example we will setup a call flow, that uses a macro to check for local business hours before forwarding a call to an agent.

## Requirements

You will need the following to complete this tutorial:

1. a DID Number
2. Lineblocs account

##  Setup Workspace

We will first bootstrap our workspace with some timezone values, so that we can later route our calls according to the correct timezone.

to access the workspace params screen: in [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Settings" -> "Workspace Params"

to add a timezone workspace param please click "Add Param". in the key field use "timezone" then use any valid timezone name in the value field. for example "America/Toronto". 

to see a full list of timezones please use [this link](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones).

#### Workspace Params

your workspace params screen should now look like the following image:
![Workspace Params](/img/frontend/docs/macros/workspace-params.png)

## Create flow

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. enter name "Business Hours Check"
3. Select "Call Forward" template
4. Click "Create"

## Adding a Macro

To add a new macro please drag the "Macro" widget from the right pane into the flow graph.

![Macro](/img/frontend/docs/macros/macro.png)

![Macro Added](/img/frontend/docs/macros/macro-added.png)

## Updating Macro

To edit your macro's function, please click the "Macro" widget, and then click![Create Function](/img/frontend/docs/macros/create-function.png) in the right pane.

In the template selection screen choose template "Business Hours Check", then click "Save".

## Set Macro Defaults

By default the macro will be setup to forward calls from 9AM-5PM Monday to Friday. To confirm these defaults, please click "Save".

## Saving Macro

Lastly for the macro's function you will be shown a code editor screen with the Macro's function. 

Please click "Save" on this screen, then give your macro a title such as "business-hours".

![Save Macro](/img/frontend/docs/macros/save-macro.png)

## Add a Playback widget

We will need to add a playback widget, so that we can play a message when our time condition is not satisfied. 

To add a playback widget for when your office is closed, please drag a "Playback" widget from the right pane into the flow editor.

In the Playback widget, please use the following settings:

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

## Add Switch widget

We will add a "Switch" widget so that we can test for our time condition and go to the correct widget. 

To add a "Switch" widget please drag a new "Switch" widget into the flow graph. rename this widget into "HoursSwitch", then change the "Variable to test" to Macro.result.

![Select Macro](/img/frontend/docs/macros/switch-widget-options.png)

## Updating Switch Links

please go to the "Links" tab of the "HoursSwitch" widget and add the following 2 links

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

the "HoursSwitch" link section should now look like the following:
![Select Macro](/img/frontend/docs/macros/switch-links.png)

## Connecting the links

Next, we will need to update the flow, so that we use our macro and the widgets we just created. 

To make adjustments to your flow so that all of the widgets are working correctly you will need to connect "Incoming Call" port from the Launch widget into the Macro's "In" port, as well as add a link from widget Macro's "Completed" port into the HoursSwitch's "In" port.

Below is an example of how the final flow should look like:
![Select Macro](/img/frontend/docs/macros/flow-updated.png)

## Using the flow on a DID number

to save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use your call flow on a DID Number:

1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. click "Save"

## Testing the flow

You should be able to call your number and see your business hours check working. Your callers will hear a message when you are unavailable and they will be forwarded to you during your business hours.

## Next Steps

in this guide we discussed setting up macros on lineblocs. for other related quickstart posts please see guides below:

[Simple IVR](http://lineblocs.com/resources/quickstarts/basic-ivr)

[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)