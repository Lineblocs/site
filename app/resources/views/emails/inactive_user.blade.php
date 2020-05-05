<h2>Your Lineblocs.com account</h2>

<div>
    <h5>Hello {{$user->getName()}},</h5>
    <p>it has been sometime since you have used lineblocs.com. we would like to remind you that you still have
        {{$user->getBillingInfo['remainingBalance']}} of credits to use in your account. be sure to make use of these credits
        towards calling. remember if you need any help or have questions please contact us at <a href="http://lineblocs.com/contact">Contact Page</a>
        
        we hope to see you soon.
    </p>
    <br/>
    <br/>
</div>
