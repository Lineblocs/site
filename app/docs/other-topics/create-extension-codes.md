# Extension Codes

At a high level, extension codes let you customize the functionality of your phone system. You can use extension codes to add new functionality to your call flows such as cold transfers and voicemail or add complex features such as intercom, custom IVRs, and more.

By default, extension codes in Lineblocs can be customized using the Lineblocs flow editor. You can also create as many extension codes as you need and assign them to custom workflows using Lineblocs flows.

## Viewing Extension Codes

To view the extension codes you have setup on your account, please go to [Settings -> Extension Codes](https://app.lineblocs.com/#/settings/extension-codes)

## Adding an Extension Code

To add a new extension code please click the ![Add Code](/img/frontend/docs/extension-codes/add-code.png) button.

You will need to give your extension code a name, code and flow. For example:

```
Name: Check Voicemail
```

```
Code: *97
```

Once you have added the extension code, please click "Save."

## Removing Extension Code

To remove an extension code click the ![Remove](/img/frontend/docs/shared/remove.png) button next to the extension code then click save.

## Testing extension codes

To test an extension code, please login to your extension then dial the extension code.

### Troubleshooting

You can troubleshoot the code for an extension code by viewing the Lineblocs call monitor. To view the latest error logs generated from your extension code:

1. On Lineblocs dashboard go to [Call Monitor](https://app.lineblocs.com/#/dashboard/call-monitor)
2. In the "Flow" field select, your flow
3. Type in the extension code in the "Dialing" field

If you need more info on debugging, please have a look at the lineblocs debugging guide. [Debugging Lineblocs flows & Calls](https://linelocs.com/resources/other-topics/debugging-lineblocs)

## Next Steps

For related articles, be sure to check out:

[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)

[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)