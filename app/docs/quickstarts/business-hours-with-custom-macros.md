# Business Hours Check using Macros

![Call Queues example](/img/frontend/docs/macros/business-hours.png)

Lineblocs macros allow you to further customize your call flows using the TypeScript language.

Using Lineblocs macros, you can create high-level integrations that include tasks such as sending a lead to a CRM or sending out an email using an API.

In this example, we will set up a call flow that uses a macro to check for local business hours before forwarding a call to an agent.

## Requirements

You will need the following to complete this tutorial:

1. A DID Number
2. Lineblocs account

##  Setup Workspace

We will first bootstrap our workspace with some timezone values to later route our calls according to the correct timezone.

To access the workspace params screen; in [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Settings" -> "Workspace Params"

To add a timezone workspace param, please click "Add Param." In the key field, use "timezone," then use any valid timezone name in the value field. For example, "America/Toronto.". 

To see a full list of time zones, please use [this link](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones).

#### Workspace Params

Your workspace params screen should now look like the following image:
![Workspace Params](/img/frontend/docs/macros/workspace-params.png)

## Create flow

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter name "Business Hours Check"
3. Select "Call Forward" template
4. Click "Create"

## Adding a Macro

To add a new macro please drag the "Macro" widget from the right pane into the flow graph.

![Macro](/img/frontend/docs/macros/macro.png)

![Macro Added](/img/frontend/docs/macros/macro-added.png)

## Updating Macro

To edit your macro's function, please click the "Macro" widget, and then click![Create Function](/img/frontend/docs/macros/create-function.png) in the right pane.

In the template selection screen, choose template "Business Hours Check," then click "Save."

## Set Macro Defaults

By default the macro will be setup to forward calls from 9AM-5PM Monday to Friday. To confirm these defaults, please click "Save".

## Saving Macro

Lastly, for the macro's function, you will be shown a code editor screen with the Macro's function. 

Please click "Save" on this screen, then give your macro a title such as "business-hours."

![Save Macro](/img/frontend/docs/macros/save-macro.png)

## Add a Playback widget

We will need to add a playback widget to play a message when our time condition is not satisfied. 

To add a playback widget for when your office is closed, please drag a "Playback" widget from the right pane into the flow editor.

In the Playback widget, please use the following settings:

```
Widget Name: ClosedMessagePlayback
```

```
Playback Type: Say
```

```
Text To Say: Our office is currently closed, please call us again from Monday to Friday 9 AM to 5 PM eastern time.
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

We will add a "Switch" widget to test for our time condition and go to the correct widget. 

To add a "Switch" widget, please drag a new "Switch" widget into the flow graph. Rename this widget into "HoursSwitch," then change the "Variable to test" to Macro.result.

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

## Connecting the Links

Next, we will need to update the flow to use our widgets.

To make adjustments to your flow so that all of the widgets are working correctly. You will need to connect the "Incoming Call" port from the Launch widget into the Macro's "In" port and add a link from widget Macro's "Completed" port into the HoursSwitch's "In" port.

Below is an example of how the final flow should look like:
![Select Macro](/img/frontend/docs/macros/flow-updated.png)

## Using the flow on a DID number

To save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use your call flow on a DID Number:

1. In the Lineblocs dashboard, please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. click "Save"

## Testing the flow

You should be able to call your number and see your business hours check working. Your callers will hear a message when you are unavailable, and they will be forwarded to you during your business hours.

## Next Steps

In this guide, we discussed setting up macros on lineblocs. For other related quickstart posts, please see the guides below:

[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)

[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)