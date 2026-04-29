<?php

namespace App\Http\Controllers;

use App\PaypalBillingAgreement;
use Auth;
use Illuminate\Http\Request;
use Log;
use PayPal\Api\Agreement;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\Payer;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalAgreementController extends Controller
{
    private $portalPath = 'portal/paypal-billing-agreement';

    public function show(Request $request)
    {
        if (!Auth::check()) {
            return redirect('auth/login');
        }

        $lastAgreement = $request->session()->get('paypal_billing_agreement.last_agreement');

        return view('paypal_agreement.billing_agreement', compact('lastAgreement'));
    }

    public function create(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'error' => 'Authentication required.'
            ], 401);
        }

        try {
            $user = Auth::user();
            $workspace = $this->resolveWorkspace($request, $user);
            if (!$workspace) {
                return response()->json([
                    'success' => false,
                    'error' => 'No workspace found for the current user.'
                ], 422);
            }

            $planId = $this->createSandboxPlan($request);
            $agreement = new Agreement();
            $agreement->setName($request->input('name', 'Sandbox Billing Agreement'))
                ->setDescription($request->input('description', 'Sandbox PayPal billing agreement for testing.'))
                ->setStartDate(gmdate('Y-m-d\TH:i:s\Z', strtotime('+25 hours')));

            $plan = new Plan();
            $plan->setId($planId);
            $agreement->setPlan($plan);

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
            $agreement->setPayer($payer);

            $createdAgreement = $agreement->create($this->makeApiContext());

            $request->session()->put('paypal_billing_agreement.pending', [
                'plan_id' => $planId,
                'user_id' => $user->id,
                'workspace_id' => $workspace->id,
                'user_email' => $user->email,
                'user_name' => $user->getName()
            ]);

            return response()->json([
                'success' => true,
                'approval_url' => $createdAgreement->getApprovalLink()
            ]);
        } catch (\Exception $ex) {
            Log::error('PayPal create agreement failed: ' . $ex->getMessage());

            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ], 422);
        }
    }

    public function approve(Request $request)
    {
        if (!Auth::check()) {
            return redirect('auth/login');
        }

        $token = $request->input('token');
        $pending = $request->session()->get('paypal_billing_agreement.pending');

        if (empty($token) || empty($pending)) {
            return redirect($this->portalPath)
                ->with('paypal_agreement_error', 'The PayPal session is missing or expired.');
        }

        try {
            $agreement = new Agreement();
            $executedAgreement = $agreement->execute($token, $this->makeApiContext());
            $agreementDetails = Agreement::get($executedAgreement->getId(), $this->makeApiContext());

            $payerInfo = $agreementDetails->getPayer()->getPayerInfo();
            if ($payerInfo) {
                $payerEmail = $payerInfo->getEmail();
            } else {
                $payerEmail = '';
            }

            if (isset($pending['user_email'])) {
                $userEmail = $pending['user_email'];
            } else {
                $userEmail = '';
            }

            if (isset($pending['user_name'])) {
                $userName = $pending['user_name'];
            } else {
                $userName = '';
            }

            $billingAgreement = PaypalBillingAgreement::updateOrCreate(
                ['agreement_id' => $agreementDetails->getId()],
                [
                    'workspace_id' => $pending['workspace_id'],
                    'user_id' => $pending['user_id'],
                    'state' => $agreementDetails->getState(),
                    'description' => $agreementDetails->getDescription(),
                    'start_date' => $agreementDetails->getStartDate(),
                    'payer_email' => $payerEmail
                ]
            );

            $request->session()->put('paypal_billing_agreement.last_agreement', [
                'agreement_id' => $agreementDetails->getId(),
                'state' => $agreementDetails->getState(),
                'description' => $agreementDetails->getDescription(),
                'payer_email' => $payerEmail,
                'plan_id' => $pending['plan_id'],
                'workspace_id' => $billingAgreement->workspace_id,
                'user_id' => $billingAgreement->user_id,
                'user_email' => $userEmail,
                'user_name' => $userName
            ]);
            $request->session()->forget('paypal_billing_agreement.pending');

            return redirect($this->portalPath)
                ->with('paypal_agreement_success', 'PayPal billing agreement approved successfully.');
        } catch (\Exception $ex) {
            Log::error('PayPal execute agreement failed: ' . $ex->getMessage());

            return redirect($this->portalPath)
                ->with('paypal_agreement_error', $ex->getMessage());
        }
    }

    public function cancel(Request $request)
    {
        $request->session()->forget('paypal_billing_agreement.pending');

        return redirect($this->portalPath)
            ->with('paypal_agreement_error', 'PayPal approval was cancelled.');
    }

    private function makeApiContext()
    {
        $clientId = env('PAYPAL_CLIENT_ID', '');
        $clientSecret = env('PAYPAL_SECRET', '');

        $apiContext = new ApiContext(
            new OAuthTokenCredential($clientId, $clientSecret)
        );

        $apiContext->setConfig([
            'mode' => 'sandbox',
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal-billing-agreement.log'),
            'log.LogLevel' => 'DEBUG'
        ]);

        return $apiContext;
    }

    private function createSandboxPlan(Request $request)
    {
        $apiContext = $this->makeApiContext();
        $returnUrl = url($this->portalPath . '/approve');
        $cancelUrl = url($this->portalPath . '/cancel');
        $amountValue = env('PAYPAL_SANDBOX_PLAN_AMOUNT', '1.00');
        $currencyCode = env('PAYPAL_SANDBOX_PLAN_CURRENCY', 'USD');

        $plan = new Plan();
        $plan->setName('Sandbox Recurring Billing Plan')
            ->setDescription('Auto-generated recurring billing plan for billing agreement testing.')
            ->setType('INFINITE');

        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Monthly Payments')
            ->setType('REGULAR')
            ->setFrequency('MONTH')
            ->setFrequencyInterval('1')
            ->setCycles('0')
            ->setAmount(new Currency([
                'value' => $amountValue,
                'currency' => $currencyCode
            ]));

        $chargeModel = new ChargeModel();
        $chargeModel->setType('SHIPPING')
            ->setAmount(new Currency([
                'value' => '0',
                'currency' => $currencyCode
            ]));
        $paymentDefinition->setChargeModels([$chargeModel]);

        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl($returnUrl)
            ->setCancelUrl($cancelUrl)
            ->setAutoBillAmount('YES')
            ->setInitialFailAmountAction('CONTINUE')
            ->setMaxFailAttempts('0')
            ->setSetupFee(new Currency([
                'value' => '0',
                'currency' => $currencyCode
            ]));

        $plan->setPaymentDefinitions([$paymentDefinition]);
        $plan->setMerchantPreferences($merchantPreferences);

        $createdPlan = $plan->create($apiContext);

        $patch = new Patch();
        $patch->setOp('replace')
            ->setPath('/')
            ->setValue((object) [
                'state' => 'ACTIVE'
            ]);

        $patchRequest = new PatchRequest();
        $patchRequest->addPatch($patch);
        $createdPlan->update($patchRequest, $apiContext);

        return $createdPlan->getId();
    }

    private function resolveWorkspace(Request $request, $user)
    {
        $workspaceId = (int) $request->input('workspace_id', $request->query('workspace_id', 0));

        if ($workspaceId > 0) {
            $workspace = \App\Workspace::find($workspaceId);
            if ($workspace) {
                return $workspace;
            }
        }

        if ($user) {
            return $user->getDefaultWorkspace();
        } else {
            return null;
        }
    }
}
