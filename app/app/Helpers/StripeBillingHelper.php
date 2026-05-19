<?php

namespace App\Helpers;

use Exception;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\User;
use App\Workspace;
use App\UserInvoice;
use App\ApiCredentialKVStore;

class StripeBillingHelper
{
    private $stripeKey;
    private $retryAttempts;
    private $paymentIntentCreator;
    private $refundCreator;
    private $apiKeySetter;

    public function __construct(
        $stripeKey = NULL,
        $retryAttempts = 0,
        $paymentIntentCreator = NULL,
        $refundCreator = NULL,
        $apiKeySetter = NULL
    )
    {
        if (is_null($stripeKey)) {
            $credentials = ApiCredentialKVStore::getRecord();
            if ($credentials['stripe_mode'] == 'live') {
            $stripeKey = $credentials['stripe_private_key'];
            } else {
            $stripeKey = $credentials['stripe_test_private_key'];
            }
        }
        $this->stripeKey = $stripeKey;
        $this->retryAttempts = $retryAttempts;
        $this->paymentIntentCreator = $paymentIntentCreator ?: function ($params) {
            return PaymentIntent::create($params);
        };
        $this->refundCreator = $refundCreator ?: function ($params) {
            return \Stripe\Refund::create($params);
        };
        $this->apiKeySetter = $apiKeySetter ?: function ($stripeKey) {
            Stripe::setApiKey($stripeKey);
        };

        // instatiate Stripe client with the provided API key
        call_user_func($this->apiKeySetter, $this->stripeKey);
    }

    public function chargeCustomer(User $user, Workspace $workspace, UserInvoice $invoice): ?Exception
    {
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
        call_user_func($this->paymentIntentCreator, $params);

        return null;
    }
    public function refundInvoice(string $stripePaymentId): ?Exception
    {
        call_user_func($this->refundCreator, ['payment_intent' => $stripePaymentId]);

        return null;
    }
}
