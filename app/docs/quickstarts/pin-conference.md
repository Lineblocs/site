# Create A Pinned Conference

![Queue Max Ext Timeout](/img/frontend/docs/pinned-conference/pinned-conference.png)

Pinned conferences allow you to create discussion rooms you and your team can access on demand.
A basic pin conference usually includes an assigned number and a set of access pins your team members can use to access the conferencing room.

In Lineblocs you can fully create basic and advanced pinned conferences as well as customize conferencing workflows as per your needs. 

In this tutorial we will go over how to create a basic pin based conference using the Lineblocs flow editor.

## Getting Started

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter a name for your flow
3. Select "Pin Conference" template
4. Click "Create"

## Add Pin Numbers

By default, the pinned conference will wait for a moderator to join, end when the moderator leaves as well as only allow up to 10 participants maximum on the call at any given time.

To update settings for your conference please open the “PinConference” widget.

![Pin Access](/img/frontend/docs/pinned-conference/pin-access.png)

![Pin Access 2](/img/frontend/docs/pinned-conference/pin-access-2.png)

## Conference Settings

By default the pinned conference will wait for a moderator to join, end when the moderator leaves as well as only allow up to 10 max participants on the call at any given time.

To update settings for your conference please open the PinConference widget.

![Conference Max](/img/frontend/docs/pinned-conference/conference-max.png)

#### Moderator Access
![moderator](/img/frontend/docs/pinned-conference/moderator.png)

#### Notifications
![moderator](/img/frontend/docs/pinned-conference/beep-1.png)

![moderator](/img/frontend/docs/pinned-conference/beep-2.png)

#### Speech Detection

![moderator](/img/frontend/docs/pinned-conference/speech.png)


## Using the flow on a DID number

To save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use your call flow on a DID Number:

1. In the lineblocs dashboard, please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. click "Save"

## Testing the flow

Your team members should now be able to join conference calls using your DID number. To test your conference as a moderator or a user you can call the DID number you setup the conference flow on.

## Next Steps

in this guide we discussed setting up pin-based conference. for other related quickstart posts please see guides below:

[Call Queues](https://lineblocs.com/resources/quickstarts/call-queues)

[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)