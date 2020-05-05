# Extension Codes

![Extension Codes](/img/frontend/docs/extension-codes/codes.png)

extension codes let you customize the functionality of your phone system by adding media services and other features to your calls. you can use extension codes to add functionality to your phone system such as cold transfers or warm transfers as well as integrate the basic and advanced elements of a phone system this could be voicemail, blocking numbers or intercom.

by default all media service extension codes in lineblocs can be created and customized using the lineblocs flow editor. you can create as many extension codes as you need and assign them to custom workflows using lineblocs editor flows.

this guide will go over how you can use lineblocs to create, manage and maintain extension codes. we will go over the steps required to add new extension codes, which extension codes come out of the box and also how you can manage extension codes using lineblocs flows.

# Default Extension Codes

below are a line of lineblocs extension codes that are created based on the template you used to sign up with lineblocs.

## Basic Call System
- Cold Transfers
- Warm Transfers
- Check Voicemail

## Advanced Call System
- Cold Transfers
- Warm Transfers
- Check Voicemail
- Intercom
- Call Parking
- Speaking Clock
- Call Monitor

## Single Call System
- Check Voicemail

# Viewing Extension Codes

to view the extension codes you have setup on your account please access the following page:

1. Login to your Lineblocs account at [app.linelocs.com/#/login](http://app.lineblocs.com/#/login)
2. In the left menu click "Settings"
3. click tab "Extension Codes"

# Adding an Extension Code

to add a new extension code please click the "Add Code" button in the Extension Codes page. you will need to give your extension code a name, code and flow. for example:

```
Name: Check Voicemail
```

```
Code: *97
```

if you have already setup a flow you can use that or you can create a new flow for the extension code. for more info on how to create a flow for a extension code please see this example: [Creating Cold Transfer](http://linelocs.com/resources/quickstarts/creating-cold-transfer)

once you have added the extension code please click "Save"

# Removing Extension Code

to remove an extension code click the "Remove" button next to the extension code and confirm deleting the extension code.

# Testing extension codes

to test an extension code please login to your extension then dial the extension code.

# troubleshooting

you can troubleshoot the code for an extension code by going to the lineblocs debugger. to view the latest warning and error logs created from your extension code please use the following steps

1. Login to your Lineblocs account at [app.linelocs.com/#/login](http://app.lineblocs.com/#/login)
2. In the left menu click "Debugger"
3. in the "Flow" field pick the extension code flow you are using
3. type in the extension code in the "Dialing" field

if you need more info on debugging please have a look at the lineblocs debugging guide. [Debugging Lineblocs flows & Calls](http://linelocs.com/resources/other-topics/debugging-lineblocs)

# Next Steps

for related articles be sure to check out:

[Usage Limits](http://lineblocs.com/resources/other-topics/usage-limits)

[Account Settings](http://lineblocs.com/resources/other-topics/account-settings)