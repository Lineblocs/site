# Create A Cold Transfer

![Cold Transfer](/img/frontend/docs/cold-transfer/main.jpg)

Lineblocs flow editor lets you programmatically create workflows for call transfers. A common type of call transfer is a cold transfer which transfers a call from one endpoint to another.

Cold transfers can usually be integrated into a PBX. Most widely used PBX systems can be used to transfer calls between extensions by using dialing codes or feature codes.

In this tutorial, we will walk you through the setup of a cold transfer using two extensions, one extension code, and a custom Lineblocs flow.

## Getting Started

To create a new Lineblocs flow for your cold transfer, you need to follow these steps:

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Create" -> "New Flow"
2. Enter a name for your flow
3. Select template "Cold Transfer" under Extension Codes
4. Click "Create"

## Creating an Extension Code

To create an extension code for your cold transfers, you need to follow these steps:

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Settings" -> "Extension Codes"
2. click "Add Code"
3. in field "Name" use "Cold Transfer"
4. in field "Code" use "*72"
5. in field "Flow" use the "Cold Transfer" flow you created earlier

![Extension Codes Info](/img/frontend/docs/cold-transfer/ext-codes-info.png)

## Creating Extensions

To do a cold transfer between two extensions, we will need to create new extensions on our account. 

Please follow steps in this post [Creating Extensions](https://lineblocs.com/resources/quickstarts/setup-extension) to create two new extensions.

Below is an example of how you may want to setup extension 1000 and 1001.

### Extension 1000

```
Username: 1000
```

```
Secret: your-strong-password
```

```
Caller ID: 1000
```

### Extension 1001

```
Username: 1001
```

```
Secret: your-strong-password
```

```
Caller ID: 1001
```

## Registering a DID

The final piece to get our flow, extension code, and inbound call routing work is registering a DID or using an existing one if you have already registered a DID.

Our DID will be used by outside callers that will need to place calls and speak to extension 1000 or 1001. 

We will register a DID and setup a call forward workflow so that extension 1000 can receive calls directly from our DID, and then forward them to 1001 using our newly created extension code.

To learn more about registering DIDs please refer to [Creating Extensions](https://lineblocs.com/resources/quickstarts/setup-extension)

To learn how to create a call transfer flow, please read this post: [Call Transfer](https://lineblocs.com/resources/quickstarts/create-cold-transfer)

## Testing Cold Transfer

You can test the cold transfer by logging into extension "1000" and having a peer login to "1001". 

When you receive calls on your DID they should be forwarded to "1000" you can press *72, and you will be redirected to an auto-attendant that will ask you the extension number you want to transfer the call to. You can then dial 1001 to complete the call transfer.

## Next Steps

In this guide we discussed setting up cold transfers on Lineblocs. For other related quickstart posts please see guides below:

[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)

[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)