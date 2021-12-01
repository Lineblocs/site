# Provision Grandstream GXP2160

Lineblocs Phone Provisioner allows you to manage global and individual phone configurations fully.

This guide will go over how to use the Lineblocs provisioning server to manage and update a Grandstream GXP2160's SIP configuration.

## Requirements

To complete this guide, you will need the following items:

1. Grandstream GXP2160
2. Lineblocs account

## Configuring GXP2160

We will first need to update our Grandstream GXP2160's "Config Server Path" to configure our phones with Lineblocs. This can be done in one of the following ways:

1. Use DHCP option 66
2. Update the "Config Server Path" in the Grandstream web GUI

In this guide, we will be updating the URL directly in the phone's web GUI.

To update your Config Server Path URL:

1. Boot on your GXP2160
2. On your phone LCD screen, go to Status -> Network Status
3. Open the "IPv4 Address" value in a browser

You will then need to login to your Grandstream control panel. 

If this is a new phone, you can login to your Grandstream Admin with username: admin and password: admin.

## Changing Provisioning Path

To change your Provisioning Path, please go to the "Maintenance -> Upgrade and Provisioning" section, then please set your "Config Server Path" to:

```
prv.lineblocs.com
```

Once you are done, please save all changes. 

Your Grandstream GXP2160 should now be setup to fetch its configuration from the Lineblocs provisioning server.

## Creating a Phone in Lineblocs

To create a new phone in Lineblocs:

1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click "Provisioning" -> "Phones"
2. In the top right, click "Create New"

On the create screen, you will need to provide a name for your phone, a MAC address, and optionally a group.

Below is an example of how you may want to set up your phone:

```
Name: Desk Phone
```

```
MAC Address: 0A:0B:0C:0D:0E:0F
```

```
Model: Grandstream GXP2160
```

## Creating a Global Template

For our phone to register and fetch its configuration details such as its Extension #, SIP Server URL, and other GXP21XX related settings, we will need to create a "Global Template.". 

To setup a global template, please go to the [Provisioning -> Global Templates](https://app.lineblocs.com/#/provision/global-settings) section in Lineblocs dashboard.

On the Global Templates page please click "Add Global Settings."

Please create a template with the following details:

```
Model: Grandstream GXP2160
```

```
Group: (None)
```

## Updating Account 1

To edit the global template's Account 1 SIP Server and Extension number, click the ![Grandstream Templates](/img/frontend/docs/provision-gxp2160/global-templates-link.png) link.

In the General Settings page, please add the following settings:

```
Account Active?: Yes
```

```
Account Name: Desk Phone
```

```
SIP Server: {your-workspace-lineblocs-username}.lineblocs.com
```

```
SIP User ID: your-ext-number
```

```
Auth ID: your-ext-number
```

```
Auth Password: your-ext-password
```

```
Name: Desk Phone
```

```
Voicemail UserID: *98
```

Please save all changes once you are complete.

## Deploying Config

Your phone is now ready to fetch its configuration from Lineblocs.

To check the status of your deployment, please go to ["Provision" -> "Deploy Now"](https://app.lineblocs.com/#/provision/deploy).

You should see that there is "1" phone pending provision on this page.

To deploy your config, please click "Begin Deployment"

![Grandstream GXP2160](/img/frontend/docs/provision-gxp2160/deploy.png)

Upon completion of the settings, the configurations should be deployed and you should get a success message with instructions to complete the deployment process.

![Grandstream GXP2160](/img/frontend/docs/provision-gxp2160/deploy-complete.png)

## Testing

Once your GXP2160 has been restarted, it should be successfully registered to Lineblocs, and you should be able to make/receive calls! 

For tips on troubleshooting, please read article [Debugging Config Deployment](https://lineblocs.com/resources/other-topics/debugging-config-deploy)

## Next Steps

In this guide, we discussed how to provide a Grandstream GXP2160 in Lineblocs phone provisioner. For related articles, be sure to check out the following posts:

[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)

[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)