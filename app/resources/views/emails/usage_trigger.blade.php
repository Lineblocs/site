<h2>Lineblocs.com</h2>

<div>
    <h5>Hello {{$user->getName()}},</h5>
    <p>We are emailing you because you have set up a usage trigger for when you go below {{$usage_trigger->percentage}}% amount of your balance. 
        Your remaining is now {{$user->getBillingInfo()['remainingBalance']}} and has passed that percentage. please remember to add credits to your account
        if you need to do so.
    </p>
    <br/>
    <br/>
</div>
