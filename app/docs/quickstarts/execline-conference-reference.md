# Reference Integration: ExecLine Conferencing

Complex conferencing workflows allow you to communicate with multiple end users on demand. Advanced conference workflows can be integrated to work with third party apps, web services and APIs. Using modern CPaaS, you can design and develop unique conferencing apps that provide your callers a stellar conferencing experience.

In this tutorial we will be looking at an advanced reference integration of a conferencing line for a small business owner.

Our conference will include two user types:

1. host                                                                                     
            ```A.K.A our small business owner who will be managing the conference line.```
2. member                                                                                      
            ```users that can call our host on demand.```

In our example conference, conference members will call into our conference line to speak with our host, regarding some service. 

## How it works

1. The conference member calls into our conferencing line and waits for the host to join the line
2. Our conference host is sent an SMS telling them a new caller is on his conference line
3. The host then joins his conferencing line to speak with the caller

## Requirements

You will need the following to complete this tutorial:

1. a DID Number
2. MessageBird account
3. Lineblocs account

## Getting Started

To create a new blank flow:

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter a name for your flow
3. Select "Blank" template
4. Click "Create"

## Setup Variables

First, we will setup variables so that we can keep track of what our host's number is when they call in. 

Our variables will allow us to switch context in our flow as well as to ensure we are providing moderator access to our host.

To setup variables, please drag a "Set Variables" widget from the right pane into the flow graph, then connect the Launch widget "Incoming Call" port into the Set Variables "In" port.

![Macro Added](/img/frontend/docs/execline/execline-2.png)


Next, please click the "Set Variables" widget to bring up its widget options, then click ![Add](/img/frontend/docs/execline/add.png)

Please add the following variables:

```
Name: host_number
```

```
Value: your-phone-number
```

```
Name: messagebird_access_token
```

```
Value: your-messagebird-access-token
```

```
Name: messagebird_number
```

```
Value: your-messagebird-number
```


## Adding a Macro

We will add a macro to allow us to integrate a custom conferencing workflow.

Our macro will be setup to subscribe to conference events as they are triggered.

To add a new macro please drag the "Macro" widget from the right pane into the flow graph, then rename this widget to "ConferenceEvents".

![Events](/img/frontend/docs/execline/events.png)



## Setup Conference Events

Our conference events widget will be setup to track when new members join the conference, as well as to make sure our conference always has at most two participants: the host and one member at a time.

To setup the conferencing events, please click the "ConferenceEvents" widget, then in the right pane under function click ![create](/img/frontend/docs/execline/create.png)

On the Macro Template screen, select template "Blank", then click "Save".

In the Lineblocs function editor, please add the following code:
        
        ```
    function sendSMS(apiKey, apiNumber, number, body) {
        var messagebird = require('messagebird')(apiKey);
        messagebird.messages.create({
            originator: apiNumber,
            recipients : [ number ],
            body : body
        });
    }
    module.exports = function(event: LineEvent, context: LineContext) {
        return new Promise(async function(resolve, reject) {

			var call = context.flow.call;
            var cell = context.cell;
            var host = event['host_number'];
            var sdk = context.getSDK();
            var conf = sdk.createConference(context.flow, "Execline");
            var number = "";

            var isWaiting = true;
            conf.on("MemberJoined", function(member: LineConferenceMember) {
                if (member.call.callParams.from === call.callParams.from) {
				   var body = `${number} is now on your conference line.`;
                   sendSMS(event['messagebird_api_key'], event['messagebird_number'], host, body);
				}
			});
            conf.on("MemberLeft", function(member: LineConferenceMember) {
                if (isWaiting && conf.totalParticipants() === 0 && member.call.callParams.from !== call.callParams.from) {
                    // let our next conference member in
                   var body = `${number} is now on your conference line.`;
                   sendSMS(event['messagebird_api_key'], event['messagebird_number'], host, body);
                   resolve(); 
                }
				if (member.call.callParams.from === call.callParams.from) {
					var body = `${number} has left your conference line`;
                   sendSMS(event['messagebird_api_key'], event['messagebird_number'], host, body);
				}
            });
            if ( conf.totalParticipants() === 0 ) {
                // let our first conference member in
                isWaiting = false;
                resolve();
            }
        });
    }
        ```


## Setup Switch

Next, we will create a "Switch" widget, so that we can change context depending on whether our host is calling, or if a member is calling.

To setup a switch, please drag a "Switch" widget from the right pane into the flow graph, then add the following two links:

### Link 1

```
Condition: Equals
```

```
Value: {{SetupVariables.host_number}}
```

### Link 2

```
Condition: Not Equals
```

```
Value: {{SetupVariables.host_number}}
```

## Create Conference Routes

Our conference will atleast require two conferencing roles, the "user", and the "moderator".

to setup the call flow routes, please create two "SetVariable" widgets: "ModeratorRoute" and "UserRoute".

Please add the following variables under "ModeratorRoute":

```
name: role
```

```
value: moderator
```

Please add the following variables under "UserRoute":

```
name: role
```

```
value: user
```

![execline 3](/img/frontend/docs/execline/execline-3.png)


## Create Conference

Our final piece of the flow will be to add a "Conference" widget.

to add a "Conference" widget into the flow, please drag a "Conference" widget from the right pane into the flow.

In the "Conference" settings please check "Wait for Moderator", and "End on Moderator leave" settings.

## Connecting the Flow

to make our flow all work together we will need to add links between the widgets created.

please add the following links:

1. SetupVariables to ConferenceEvents
2. ConferenceEvents to Switch
3. Switch Link 1 to ModeratorRoute
4. Switch Link 2 to UserRoute
5. ModeratorRoute to Conference
6. UserRoute to Conference

![execline 4](/img/frontend/docs/execline/execline-4.png)


## Using the flow on a DID number

to save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use your call flow on a DID Number:

1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. click "Save"

## Testing the flow

To test as a caller:
call the conferencing line number

To test as a host:
use the host number to call the conference line

## Next Steps

in this guide we went over a reference conferencing app integration. for more related articles please see:

[Create a cold transfer](http://lineblocs.com/resources/quickstarts/setup-cold-transfers)

[Setup Macro for Business Hours](http://lineblocs.com/resources/quickstarts/business-hours-with-custom-macros)