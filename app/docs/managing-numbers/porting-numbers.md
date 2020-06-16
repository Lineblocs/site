# Porting Numbers

![Port Page](/img/frontend/docs/port-numbers/port-page.png)

the lineblocs app currently supports port-in requests from numbers based in Canada that are already hosted in a region where we offer a DID services in.

for a full of supported regions please see [Supported Rate Centers](https://lineblocs.com/resources/other-topics/supported-rate-centers)

## Port-In Request Requirements

if you are trying to port in a number to lineblocs please keep in mind the following requirements:

1. the number you are trying port-in should not have been disconnected by the provider
2. no dispute should be open with the porting number
3. porting number should not be scheduled for disconnection
3. the porting number should not have any contract with the provider
4. the porting number you port must be available in a rate center we support

## Start Port Request

to start a Port-In request please login to the Lineblocs portal then access the port request page at [Create Port Request](https://app.lineblocs.com/#/dashboard/dids/ports/create)

on the port request page you will need to provide us the following info:

1. Your First and Last Name
2. Local Address
3. letter of authorization (LOA) - a letter of authorization from the number owner
4. customer service record (CSR) - a customer service record
5. recent invoice from your provider - an invoice dated no longer than 90 days from the day you make the port

## Submitting Port-In Request

to submit your port-in request please fill in the fields on the [Create Port Request](https://app.lineblocs.com/#/dashboard/dids/ports/create) and then click the "Save" button.

## Port-In Review Stages

after you have submitted your port-in request you will be provided updates for the port-in statuses. the statuses your port-in request will go through can include the following:

1. Pending Review

        this is when we have received your port in request but have not confirmed on our end yet.

2. Received

        port in request was received and lineblocs has confirmed it will attempt the port-in request.

3. Submitted To Provider

        the port request was sent to your current carrier

3. Confirmed

        your port-in has been confirmed and an ETA has been provided.

4. Completed

        your port-in is now completed

you will be notified via email whenever the port-in request status as well as when an ETA for the port in is provided.

you can also track the status of your Port-In request by accessing the [Create Port Request](https://app.lineblocs.com/#/dashboard/dids/ports/create) and checking the Status column in the port numbers list.

![Port Status](/img/frontend/docs/port-numbers/port-status.png)

## Editing Port Request

you may be required to edit your port-in request depending on whether more info is required about your port in number or personal information during the port-in process. to update your port-in request please use the following steps:

1. Login to your Lineblocs account at [app.linelocs.com/#/login](http://app.lineblocs.com/#/login)
2. In the left nav click "DID Numbers"
3. In the top right click "Port Numbers"
4. click the pencil icon on the port request you want to edit

## Next Steps

in this article we discussed porting numbers. for more info on managing numbers or billing related to numbers be sure to see articles below:

[Managing Numbers](http://lineblocs.com/resources/managing-numbers/manage-numbers)

[Monthly Invoices](http://lineblocs.com/resources/billing-and-pricing/monthly-invoices)