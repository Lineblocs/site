# Call Queues

Call queues can allow you receive multiple calls simultaneously. A well-designed call queue can also provide a smooth experience for a long wait time for a call.

In this guide, we will be creating a primary call queue using the Lineblocs flow editor. The call queue will be assigned to all our extensions and set up with basic options. 

## Getting Started

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard), click "Create" -> "New Flow"
2. Enter a name for your flow
3. Select the "Queue Example" template
4. Click "Create"


## Add Extensions

By default, the call queue will be set up with no extensions. You can add extensions to your queue by adjusting the Queue's widget options.

To update the widget extensions settings for your queue, please click the "SupportQueue" to open its options, then select the extensions you would like to include in the "Select Extensions" field.

![Call Queues example](/img/frontend/docs/call-queue/extension-select.png)

## Max Queue Wait Time

Maximum queue wait time allows you to adjust how long a caller can wait in the call queue before either terminating the call or going to an alternate destination.

By default, the maximum queue wait time is set to 60 seconds.

To change the maximum wait time for the queue, please update the "Max Wait Time" option.

![Queue Max Timeout](/img/frontend/docs/call-queue/queue-max-wait.png)

## Max Extension Timeout

To update how long you want to ring an agent's phone, you can update the "Max Extension Timeout" option.

![Queue Max Ext Timeout](/img/frontend/docs/call-queue/queue-max-ext-timeout.png)

## Music On Hold

By default, all call queues will play music on hold while the caller waits for an agent to answer the call. 

Music On Hold will be played recurringly -- until the caller hangs up, an agent picks up a call, or the maximum queue wait time elapses.

You can customize the music you play in your queue updating, the "Music On Hold URL" setting in the widget settings box. 

## End Result

After you have made your changes, your flow should now look similar to the following image:
![Queue Max Ext Timeout](/img/frontend/docs/call-queue/main.png)

## Using the flow on a DID number

To save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use your call flow on a DID Number:

1. In the Lineblocs dashboard, please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. Click "Save"

## Testing the flow

Your callers should now be placed in a queue with music on hold when they call your number. And your extensions will receive calls from the queue in the order they came in.

## Next Steps

In this guide, we discussed setting up call queues on Lineblocs. for other related quickstart posts, be sure to view the following:

[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)

[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)