<?php

namespace App\Helpers;

use Exception;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\User;
use App\Workspace;
use App\UserInvoice;

class StripeBillingHelper
{
    private $stripeKey;
    private $retryAttempts;

    public function __construct(string $stripeKey, int $retryAttempts)
    {
        $this->stripeKey = $stripeKey;
        $this->retryAttempts = $retryAttempts;
    }

    public function chargeCustomer(User $user, Workspace $workspace, UserInvoice $invoice): ?Exception
    {
        Stripe::setApiKey($this->stripeKey);

        // Retrieve the primary payment method ID for the customer
        $userCard = $workspace->userCards()->where('primary', 1)->first();

        if (!$userCard) {
            return new Exception("Primary payment method not found for workspace.");
        }

        $paymentMethodId = $userCard->stripe_payment_method_id;

        $descriptor = config('app.deployment_domain') . ' invoice';
        $customerId = $user->stripe_id;
        $redirectUrl = MainHelper::createUrl('payment-handlers/stripe/confirm-payment-intent');

        // Define the parameters for creating a PaymentIntent
        $params = [
            'amount' => $invoice->cents,
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
            'customer' => $customerId,
            'payment_method' => $paymentMethodId,
            'return_url' => $redirectUrl,
            'off_session' => true,
            'confirm' => true,
            'statement_descriptor' => $descriptor
        ];

        // Create the PaymentIntent
        PaymentIntent::create($params);

        return null;
    }
}
