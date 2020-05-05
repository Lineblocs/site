# Setup Cold Transfers

![Setup cold transfers](/img/frontend/docs/macros/business-hours.png)

Lineblocs macros allow you to add custom functionality to your flow. macros can be created based on a template and customized using the TypeScript language. 

some examples of where you may want to use macros includes sending a lead to a CRM like salesforce, sending out an email using an API or doing some other internal work.

in this example we will setup a flow that forwards a call to our agent or plays back an office closed message depending on the day and time.

## Getting Started

1. Login to your Lineblocs account at [app.linelocs.com/#/login](http://app.lineblocs.com/#/login)
2. click "Settings" in the left menu
3. click "Workspace Params"

## Adding A Parameter

we will add a workspace param so that we know which timezone we need to use to check for our agent's availability. 

to add a timezone workspace param please click "Add Param". in the key field use "timezone" then use any valid timezone name in the value field. for example "America/Toronto". 

to see a full list of timezones please use [this link](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones).

your workspace params screen should now look like the following image
![Workspace Params](/img/frontend/docs/macros/workspace-params.png)

when you are done please click "Save"

## Creating the flow

to create a new lineblocs flow based on your timezone availability. please use the following steps:

1. Login to your Lineblocs account at [app.linelocs.com/#/login](http://app.lineblocs.com/#/login)
2. click "Create" button on the top right
3. click "New Flow"
4. enter name "Business Hours Check"
5. select example template "Call Forward"

![flow select](/img/frontend/docs/macros/flow-select.png)

# Adding a Macro

to add a new macro please drag the "Macro" widget from the right pane into the flow graph.

![Macro](/img/frontend/docs/macros/macro.png)

## example flow with macro

![Macro Added](/img/frontend/docs/macros/macro-added.png)

# updating the macro

the macro widget lets you select a TypeScript function or create a new function. currently we have no code added in our macro. to add custom code to our macro please click the "Macro" widget and then click "Create Function" in the right pane.

![Macro Added](/img/frontend/docs/macros/create-function.png)

in the template selection screen choose template "Hours Check"
![Hours Template](/img/frontend/docs/macros/hours-template.png)
# customizing the macro

the macro by default will check for working hours and days. in the template example it is set to 9AM-5PM monday to friday using the timezone you set. if you want to customize the macro to change this time or add any other logic you can do this in the code editor.

![Flow Editor](/img/frontend/docs/macros/flow-editor.png)

once your macro function is updated please click "Save" and give your macro a name. for example "business hours".

![Flow Editor](/img/frontend/docs/macros/save-macro.png)

## setting the Macro function

in the "Macro" settings please update the macro to use "business-hours" function you added earlier.

![Select Macro](/img/frontend/docs/macros/select-macro.png)

## adding a Playback widget

we will also need to add a closed message widget so that we can play a message when our time condition is not satisfied. to add a playback widget for when your office is closed please drag a "Playback" widget from the right pane into the flow editor and use the following settings on this widget.

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


## adding a Switch widget

we will add a "Switch" widget so that we can test for our time condition and go to the correct widget. 

to add a "Switch" widget please drag a new "Switch" widget into the flow graph. rename this widget into "HoursSwitch" then change the "Variable to test" to Macro.result.

![Select Macro](/img/frontend/docs/macros/switch-widget-options.png)

## updating switch links

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

## updating the flow

next we will need to update the flow so that we use our macro and the widgets we just created. to make adjustments to your flow so that all of the widgets are working correctly you will need to connect "Incoming Call" port from the Launch widget into the Macro's "In" port as well as add a link from widget Macro's "Completed" port into the HoursSwitch's "In" port.

below is an example of how the final flow should look like:
![Select Macro](/img/frontend/docs/macros/flow-updated.png)

# Using the flow on a DID number

1. In the lineblocs dashboard please click DID Numbers -> My Numbers
2. Click the pencil icon on a number you want to use the flow on
3. In the flow selection list use the flow name you created earlier
4. click "Save"

# Testing the flow

You should be able to call your number and see your business hours check working. Your callers will hear a message when you are unavailable and they will be forwarded to you during your business hours.

# Next Steps

in this guide we discussed setting up macros on lineblocs. for other related quickstart posts please see guides below:

[Simple IVR](http://lineblocs.com/resources/quickstarts/basic-ivr)

[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)