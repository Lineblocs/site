<?php

use App\Helpers\PaypalSubscriptionHelper;
use App\Helpers\StripeBillingHelper;
use App\User;
use App\UserCard;
use App\UserInvoice;
use App\Workspace;

class GatewayHelpersTest extends TestCase
{
    public function testStripeChargeCustomerCreatesPaymentIntentWithPrimaryCard()
    {
        $capturedApiKey = null;
        $capturedPaymentIntent = null;

        $helper = new StripeBillingHelper(
            'sk_test_mocked',
            0,
            function ($params) use (&$capturedPaymentIntent) {
                $capturedPaymentIntent = $params;
            },
            null,
            function ($apiKey) use (&$capturedApiKey) {
                $capturedApiKey = $apiKey;
            }
        );

        $user = new User(['stripe_id' => 'cus_mocked']);
        $card = new UserCard(['stripe_payment_method_id' => 'pm_mocked']);
        $workspace = new GatewayTestWorkspace($card);
        $invoice = new UserInvoice(['cents' => 2599]);

        $result = $helper->chargeCustomer($user, $workspace, $invoice);

        $this->assertNull($result);
        $this->assertEquals('sk_test_mocked', $capturedApiKey);
        $this->assertEquals(2599, $capturedPaymentIntent['amount']);
        $this->assertEquals('usd', $capturedPaymentIntent['currency']);
        $this->assertEquals('cus_mocked', $capturedPaymentIntent['customer']);
        $this->assertEquals('pm_mocked', $capturedPaymentIntent['payment_method']);
        $this->assertTrue($capturedPaymentIntent['automatic_payment_methods']['enabled']);
        $this->assertTrue($capturedPaymentIntent['off_session']);
        $this->assertTrue($capturedPaymentIntent['confirm']);
        $this->assertContains('payment-handlers/stripe/confirm-payment-intent', $capturedPaymentIntent['return_url']);
    }

    public function testStripeChargeCustomerReturnsExceptionWhenPrimaryCardIsMissing()
    {
        $helper = new StripeBillingHelper(
            'sk_test_mocked',
            0,
            function () {
                $this->fail('Stripe should not be called without a primary card.');
            },
            null,
            function () {
            }
        );

        $result = $helper->chargeCustomer(
            new User(['stripe_id' => 'cus_mocked']),
            new GatewayTestWorkspace(null),
            new UserInvoice(['cents' => 2599])
        );

        $this->assertInstanceOf('Exception', $result);
        $this->assertEquals('Primary payment method not found for workspace.', $result->getMessage());
    }

    public function testStripeRefundCreatesRefundForPaymentIntent()
    {
        $capturedRefund = null;

        $helper = new StripeBillingHelper(
            'sk_test_mocked',
            0,
            null,
            function ($params) use (&$capturedRefund) {
                $capturedRefund = $params;
            },
            function () {
            }
        );

        $result = $helper->refundInvoice('pi_mocked');

        $this->assertNull($result);
        $this->assertEquals(['payment_intent' => 'pi_mocked'], $capturedRefund);
    }

    public function testPayPalCreateAgreementReturnsApprovalLinkAndToken()
    {
        $createdAgreement = new GatewayTestPayPalAgreement('I-123', 'Active');
        $createdAgreement->approvalLink = 'https://paypal.test/approve';
        $createdAgreement->token = 'EC-mocked';

        $agreement = new GatewayTestPayPalAgreement();
        $agreement->createdAgreement = $createdAgreement;

        $helper = new PaypalSubscriptionHelper(
            new stdClass(),
            function () use ($agreement) {
                return $agreement;
            }
        );

        $result = $helper->createAgreement(
            'P-123',
            'Mocked agreement',
            'Gateway test agreement',
            '2026-06-19T00:00:00Z'
        );

        $this->assertTrue($result['success']);
        $this->assertEquals('https://paypal.test/approve', $result['approval_url']);
        $this->assertEquals('EC-mocked', $result['token']);
        $this->assertEquals('Mocked agreement', $agreement->name);
        $this->assertEquals('Gateway test agreement', $agreement->description);
        $this->assertEquals('2026-06-19T00:00:00Z', $agreement->startDate);
        $this->assertEquals('P-123', $agreement->plan->getId());
        $this->assertEquals('paypal', $agreement->payer->getPaymentMethod());
    }

    public function testPayPalGetAgreementDetailsUsesRetriever()
    {
        $agreement = new GatewayTestPayPalAgreement('I-123', 'Active');
        $requestedAgreementId = null;

        $helper = new PaypalSubscriptionHelper(
            new stdClass(),
            null,
            function ($agreementId) use (&$requestedAgreementId, $agreement) {
                $requestedAgreementId = $agreementId;
                return $agreement;
            }
        );

        $result = $helper->getAgreementDetails('I-123');

        $this->assertTrue($result['success']);
        $this->assertEquals('I-123', $requestedAgreementId);
        $this->assertSame($agreement, $result['agreement']);
    }

    public function testPayPalCancelAgreementCancelsRemoteAgreementAndUpdatesLocalRecord()
    {
        $agreement = new GatewayTestPayPalAgreement('I-123', 'Active');
        $updatedAgreementId = null;
        $updatedAttributes = null;

        $helper = new PaypalSubscriptionHelper(
            new stdClass(),
            null,
            function () use ($agreement) {
                return $agreement;
            },
            null,
            function ($agreementId, $attributes) use (&$updatedAgreementId, &$updatedAttributes) {
                $updatedAgreementId = $agreementId;
                $updatedAttributes = $attributes;
            }
        );

        $result = $helper->cancelAgreement('I-123', 'Testing cancellation');

        $this->assertTrue($result['success']);
        $this->assertEquals('Agreement cancelled successfully', $result['message']);
        $this->assertEquals('Testing cancellation', $agreement->cancelNote);
        $this->assertEquals('I-123', $updatedAgreementId);
        $this->assertEquals(['state' => 'Cancelled'], $updatedAttributes);
    }
}

class GatewayTestWorkspace extends Workspace
{
    private $primaryCard;

    public function __construct($primaryCard)
    {
        parent::__construct();
        $this->primaryCard = $primaryCard;
    }

    public function userCards()
    {
        return new GatewayTestUserCardsRelation($this->primaryCard);
    }
}

class GatewayTestUserCardsRelation
{
    private $primaryCard;

    public function __construct($primaryCard)
    {
        $this->primaryCard = $primaryCard;
    }

    public function where($column, $value)
    {
        return $this;
    }

    public function first()
    {
        return $this->primaryCard;
    }
}

class GatewayTestPayPalAgreement
{
    public $approvalLink;
    public $cancelNote;
    public $createdAgreement;
    public $description;
    public $id;
    public $name;
    public $payer;
    public $plan;
    public $startDate;
    public $state;
    public $token;

    public function __construct($id = null, $state = null)
    {
        $this->id = $id;
        $this->state = $state;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function setPlan($plan)
    {
        $this->plan = $plan;
        return $this;
    }

    public function setPayer($payer)
    {
        $this->payer = $payer;
        return $this;
    }

    public function create($apiContext)
    {
        return $this->createdAgreement ?: $this;
    }

    public function cancel($note, $apiContext)
    {
        $this->cancelNote = $note;
    }

    public function getApprovalLink()
    {
        return $this->approvalLink;
    }

    public function getToken()
    {
        return $this->token;
    }
}
