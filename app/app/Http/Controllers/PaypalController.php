<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\PaypalSubscriptionHelper;
use Hash;


class PaypalController extends ApiAuthController
{

    public function createBillingAgreement(Request $request)
    {
        try {
            $startDate = NULL;
            PaypalSubscriptionHelper::createAgreement($planId, $name, $description, $startDate);


            return response()->json([
                'success' => true,
                'approval_url' => $agreement->getApprovalLink(),
                'token' => $agreement->getToken()
            ]);
        } catch (\Exception $ex) {
            return response::json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
    }

    /**
     * Execute a billing agreement after user approval
     * 
     * @param string $token PayPal token from approval redirect
     * @param int $userId User ID to associate with agreement
     * @return array Contains success status and either agreement details or error message
     */
    public function executeBillingAgreement(Request $request)
    {
        try {
            $startDate = NULL;
            $user = $this->getUser($request);
            $workspace = $this->getWorkspace($request);
            $result = PaypalSubscriptionHelper::executeAgreement($token, $workspace->id, $user->id);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
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
    public function cancelBillingAgreement(Request $request)
    {
        try {
            $note = 'Cancelled by user';

            $user = $this->getUser($request);
            $workspace = $this->getWorkspace($request);
            $subscriptionRecord = PaypalSubscriptionHelper::where('workspace_id', $workspace->id)->first();

            $agreement = Agreement::get($agreementId, $this->apiContext);
            $agreement->cancel($note, $this->apiContext);

            // Update local database record
            $subscriptionRecord->update(['state' => 'Cancelled']);

            return response()->json([
                'success' => true,
                'message' => 'Agreement cancelled successfully'
            ]);
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'error' => $ex->getMessage()
            ];
        }
    }

}