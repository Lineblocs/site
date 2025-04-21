<?php

namespace App\Helpers;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use App\BillingAgreement;

class PaypalSubscriptionHelper
{
    private $apiContext;
    
    /**
     * Initialize PayPal API context
     */
    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),
                config('services.paypal.secret')
            )
        );

        $this->apiContext->setConfig([
            'mode' => config('services.paypal.mode'),
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'DEBUG'
        ]);
    }

    /**
     * Create a new billing agreement
     * 
     * @param string $planId PayPal Plan ID
     * @param string $name Agreement name
     * @param string $description Agreement description
     * @param string $startDate Optional start date (defaults to 1 month from now)
     * @return array Contains success status and either approval_url or error message
     */
    public function createAgreement($planId, $name, $description, $startDate = null)
    {
        try {
            $agreement = new Agreement();
            $agreement->setName($name)
                ->setDescription($description)
                ->setStartDate($startDate ?? gmdate("Y-m-d\TH:i:s\Z", strtotime("+1 month")));

            $plan = new Plan();
            $plan->setId($planId);
            $agreement->setPlan($plan);

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
            $agreement->setPayer($payer);

            $agreement = $agreement->create($this->apiContext);
            
            return [
                'success' => true,
                'approval_url' => $agreement->getApprovalLink(),
                'token' => $agreement->getToken()
            ];
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'error' => $ex->getMessage()
            ];
        }
    }

    /**
     * Execute a billing agreement after user approval
     * 
     * @param string $token PayPal token from approval redirect
     * @param int $userId User ID to associate with agreement
     * @return array Contains success status and either agreement details or error message
     */
    public function executeAgreement($token, $userId)
    {
        try {
            $agreement = new Agreement();
            $agreement->execute($token, $this->apiContext);

            // Get agreement details
            $agreement = Agreement::get($agreement->getId(), $this->apiContext);

            // Store agreement in database
            $billingAgreement = BillingAgreement::create([
                'workspace_id' => $workspaceId,
                'user_id' => $userId,
                'agreement_id' => $agreement->getId(),
                'state' => $agreement->getState(),
                'description' => $agreement->getDescription(),
                'start_date' => $agreement->getStartDate(),
                'payer_email' => $agreement->getPayer()->getPayerInfo()->getEmail()
            ]);

            return [
                'success' => true,
                'agreement' => $billingAgreement
            ];
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'error' => $ex->getMessage()
            ];
        }
    }

    /**
     * Store billing agreement in database
     * 
     * @param Agreement $agreement PayPal Agreement instance
     * @param int $userId User ID to associate with agreement
     * @return BillingAgreement
     */
    private function storeBillingAgreement($agreement, $workspaceId, $userId)
    {
        return BillingAgreement::create([
            'workspace_id' => $workspaceId,
            'user_id' => $userId,
            'agreement_id' => $agreement->getId(),
            'state' => $agreement->getState(),
            'description' => $agreement->getDescription(),
            'start_date' => $agreement->getStartDate(),
            'payer_email' => $agreement->getPayer()->getPayerInfo()->getEmail()
        ]);
    }

    /**
     * Get agreement details
     * 
     * @param string $agreementId PayPal Agreement ID
     * @return array Contains success status and either agreement details or error message
     */
    public function getAgreementDetails($agreementId)
    {
        try {
            $agreement = Agreement::get($agreementId, $this->apiContext);
            return [
                'success' => true,
                'agreement' => $agreement
            ];
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'error' => $ex->getMessage()
            ];
        }
    }

    /**
     * Cancel an existing agreement
     * 
     * @param string $agreementId PayPal Agreement ID
     * @param string $note Cancellation note
     * @return array Contains success status and message
     */
    public function cancelAgreement($agreementId, $note = 'Cancelled by user')
    {
        try {
            $agreement = Agreement::get($agreementId, $this->apiContext);
            $agreement->cancel($note, $this->apiContext);

            // Update local database record
            BillingAgreement::where('agreement_id', $agreementId)
                ->update(['state' => 'Cancelled']);

            return [
                'success' => true,
                'message' => 'Agreement cancelled successfully'
            ];
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'error' => $ex->getMessage()
            ];
        }
    }
}