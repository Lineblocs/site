# Create A Pinless Conference

![Pinless Conference](/img/frontend/docs/pinless-conference/main.png)

Pinless conferences allow you to create discussion rooms you and your team can access on demand.
A basic pinless conference usually includes a dial-in phone number and a set of assigned attendee numbers.

In Lineblocs you can entirely create basic and advanced pinless conferences as well as customize pinless conferencing workflows as per your needs

This tutorial will go over how to create a basic pinless conference using the Lineblocs flow editor.

## Getting Started

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter a name for your flow
3. Select the "Pin Conference" template
4. Click "Create"

## Setup Attendees

By default, the conference will be set up with no attendee numbers that can call into the conference.

You can change the numbers your moderator and users will be using to join your conference by updating the access numbers used for your meeting.

To view your access numbers, please click the "SetupAttendees" to bring up its options.

![Access Numbers](/img/frontend/docs/pinless-conference/access-numbers.png)

## Conference Settings

To update settings for your conference please open the "PinlessConference" widget.

![Conference Max](/img/frontend/docs/pinned-conference/conference-max.png)

#### Moderator Access
![moderator](/img/frontend/docs/pinned-conference/moderator.png)

#### Notifications
![moderator](/img/frontend/docs/pinned-conference/beep-1.png)

![moderator](/img/frontend/docs/pinned-conference/beep-2.png)

#### Speech Detection

![moderator](/img/frontend/docs/pinned-conference/speech.png)

## Using the flow on a DID number

to save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.

To use your call flow on a DID Number:

1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)
2. Click the "Edit" button next to your number
3. Update the "Attached Flow" field
4. click "Save"

## Testing

Your team members should now be able to join conference calls using your DID number. To test your conference, you can call your DID number using a moderator or user caller ID.

## Next Steps

In this guide, we discussed setting up a pinless-based conference. For other related quickstart posts, please see guides below:

[Setup Pin Conference](https://lineblocs.com/resources/quickstarts/pin-conference)

[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)