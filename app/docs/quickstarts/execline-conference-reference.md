# Reference Integration: ExecLine Conferencing

Complex conferencing workflows allow you to communicate with multiple end users on demand. Advanced conference workflows can be integrated to work with just about anything. using modern CPaaS, you can design and develop unique conferencing apps that allows your developers to access higher level APIs.

In this tutorial we will be looking at an advanced reference integration of a conferencing line for a small business owner.

Our conference will include two user types:

1. host                                                                                     
            ```A.K.A our small business owner who will be managing the conference line.```
2. member                                                                                      
            ```users that can call our host on demand.```

In our example conference, callers will be able to call into our conferencing line to speak with our host, on demand. 

The goal of this conference integration is to mask phone numbers among two or more parties -- as well as to allow larger volume of calls, using Lineblocs flows.

## Requirements

You will need the following to complete this tutorial:

1. a DID Number
2. MessageBird account
3. Lineblocs account

## Getting Started

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter a name for your flow
3. Select "Blank" template
4. Click "Create"

## Setup Variables

We will first setup variables so that we can keep track of what our host's number is when they call in. Our variables will allow us to switch context in our flow as well as to ensure we are providing moderator access to our host.

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


## Adding a Macro

We will add a macro to allow us to integrate a custom conferencing workflow.

Our macro will be setup, in a way that allows us to subscribe to conference events triggered.

To add a new macro please drag the "Macro" widget from the right pane into the flow graph, then rename this widget to "ConferenceEvents".

![Events](/img/frontend/docs/execline/events.png)



## Setup Conference Events

Our conference events widget will be setup to track when new members join the conference, as well as to make sure our conference always has at most two participants: the host and one member at a time.

To setup the conferencing events, please click the "ConferenceEvents" widget, then in the right pane under function click ![create](/img/frontend/docs/execline/create.png)

On the Macro Template screen, select template "Blank", then click "Save".

In the Lineblocs function editor, please add the following code:
        
        ```
        function sendSMS(event, number, body) {
            var messagebird = require('messagebird')(event['messagebird_api_key']);
            messagebird.messages.create({
                originator : event['sms_number'],
                recipients : [ number ],
                body : body
            });
        }
        module.exports = function(event: LineEvent, context: LineContext) {
            return new Promise(async function(resolve, reject) {
        
                var cell = context.cell;
                var host = event['host_number'];
                var sdk = context.getSDK();
                var conf = sdk.createConference(context.flow, "Execline");
                var number = "";
                if ( conf.waitingParticipants.length > 0 ) {
                    // only 1 allowed at a time
                    cell.eventVars['result'] =  'closed';
                    resolve();
                    return;
                }
        
                conf.on("MemberJoined", function(member) {
        
                    var number = member.call.from;
                    var body = `${number} is now on your conference line.`;
                    sendSMS(event['messagebird_api_key'], host, body);
                });
        
                conf.on("MemberLeft", function(member) {
                    var body = `${number} has left your conference line`;
                    sendSMS(host, body);
                });
        cell.eventVars['result'] =  'open';
                resolve();
            });
        }
        ```


## Setup Switch

Next, we will create a "Switch" widget, so that we can change context depending on whether our host is calling, or if a member is calling.

Please drag a "Switch" widget from the right pane into the flow graph, then add the following two link:

## Link 1

```
Condition: Equals
```

```
Value: {{SetupVariables.host_number}}
```

```
Cell to link: ModeratorRoute
```

## Create Conference Routes

To switch context based on the caller ID, we will create two SetVariable widgets "ModeratorRoute", and "UserRoute".

Our SetVariable widgets will be setup so that we can determine the role of the caller.

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


## Create Conference

To make it all work together, we will need to add a Conference widget. Please add a "Conference" widget into the flow.

In the conference widget, please use the following settings:

![Wait](/img/frontend/docs/execline/wait-moderator.png)

![End](/img/frontend/docs/execline/end-moderator.png)


## Next Steps

in this guide we discussed how you can save a widget and reuse it. for more related articles please see:

[Create a cold transfer](http://lineblocs.com/resources/quickstarts/setup-cold-transfers)

[Setup Macro for Business Hours](http://lineblocs.com/resources/quickstarts/business-hours-with-custom-macros)