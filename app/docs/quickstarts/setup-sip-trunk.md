# Setting up a SIP trunk

A Lineblocs SIP trunk allows you to interconnect the Lineblocs system with your external phone system. By utilizing the Lineblocs SIP trunks feature, you can integrate the Lineblocs network with your hosted IP-PBX. You can also link the SIP trunk with one or more of the DID numbers you have purchased.

Normally, hosted SIP trunks are useful when you need to send your calls to an external phone system. By using hosted SIP trunks, you can create sophisticated SIP routing workflows that work in tandem with your hosted SIP infrastructure. 

In this guide, we go over how to create a basic SIP trunk and how to connect it a IP-PBX server.

## Requirements

You will need the following to create a hosted SIP trunk on Lineblocs:

1. Lineblocs account
2. an external IP-PBX

## Creating SIP trunk

In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Hosted trunks" -> "Create New"

## Configure routing settings

On the create page you will find various settings for updating your SIP trunk.

It is recommended that you configure settings optimally.

In order to setup a hosted SIP trunk correctly it is recommended that you fill in all the fields and ensure all settings are correct.

### Updating the origination settings

To update the origination settings, please click the "Origination" tab.

In the origination panel, you can configure a primary and secondary SIP server. These servers will be utilized when Lineblocs needs to send a call to your SIP trunk.

Both the main SIP server and recovery SIP server need a valid SIP URI. For example:

```
sip:mysipserver.example.org
```

### Termination

To access the termination settings, please click the "Termination" tab.

On the termination tab you will find any relevant settings for SIP termination. You can configure any valid domain name here and use it with your SIP trunk. For example:

```
myhostedtrunk.pstn.lineblocs.com
```

> note the pstn.lineblocs.com domain will be appended to your domain automatically

### Integrate trunk with DID numbers

It is also recommended that you configure atleast one DID number with your SIP trunk. 

To edit your DID numbers, please click the DID numbers tab.

On this page, you can check any DID numbers you want to link with your trunk.

## Saving settings

To save the SIP trunk, please click the "Save" button.

## Connecting Lineblocs SIP trunk to external IP-PBX

Once you have saved the SIP trunk you can start configuring it with your IP-PBX.

Note that each IP-PBX has its own unique settings and you will need to follow best practices.

Fortunately, We have created a list of guides for common IP-PBX. This can be found [here](https://lineblocs.com/resources/other-topics/interconnection-guides) 

## Testing the SIP trunk

You can test the SIP trunk by making calls from your hosted IP-PBX.

If everything is configured correctly the calls should connect and you should be able to hear audio.

## Next Steps

In this guide we discussed setting up a hosted SIP trunk. For more guides about related topics please refer to the following articles:

[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)

[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)