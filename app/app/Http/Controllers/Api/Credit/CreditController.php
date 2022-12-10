<?php

namespace App\Http\Controllers\Api\Credit;
use \App\Http\Controllers\Api\ApiAuthController;
use \App\Http\Controllers\Api\HasStripeController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Call;
use \App\Transformers\CallTransformer;
use \App\Helpers\MainHelper;
use \App\UserCredit;
use \App\Helpers\SIPRouterHelper;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;

use \Config;
use \Exception;
use \Log;




class CreditController extends HasStripeController {
    public function addCredit(Request $request)
    {
        $data = $request->all();
        $amountInCents = MainHelper::toCents($data['amount']);
        $user = $this->getUser($request);
        try {
          \Stripe\Charge::create([
            'amount' => $amountInCents,
            'currency' => 'usd',
            'description' => 'Charge for LineBlocs',
            'customer' => $user->stripe_id
          ]); 
        } catch (Exception $ex) {
          \Log::error("error while charging stripe customer: " . $ex->getMessage());
          return $this->errorInternal($request, 'Error charging stripe user');
        }

        $credit = [
          'cents' => $amountInCents,
          'card_id' => $data['card_id'],
          'user_id' => $user->id,
          'status' => 'approved'
        ];
        UserCredit::create($credit);
        if ($user->trial_mode) {
          $user->update([
            'trial_mode' => FALSE,
            'plan' => 'standard'
          ]);
          $plans = Config::get("service_plans");
          $standard = $plans['standard'];
          $upgraded = SIPRouterHelper::modifyUser($user, $standard['ports']);
          if (!$upgraded) {
            return FALSE;
          }
        }
        
        return $this->response->noContent();
    }
    public function checkoutWithPayPal(Request $request)
    {
        $user = $this->getUser($request);
        \Log::info("using paypal user is: " .$user->id);
        $data = $request->all();
        $credits = $data['amount'];

        // ### Payer
        // A resource representing a Payer that funds a payment
        // For paypal account payments, set payment method
        // to 'paypal'.
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // ### Itemized information
        // (Optional) Lets you specify item wise
        // information
        $item1 = new Item();
        $item1->setName('LineBlocs credits')
            ->setCurrency('USD')
            ->setQuantity(1)
            //->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice($credits);
        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        // ### Additional payment details
        // Use this optional field to set additional
        // payment information such as tax, shipping
        // charges etc.
        $details = new Details();
        $details->setShipping(0.0)
            ->setTax(0.0)
            ->setSubtotal($credits);

        // ### Amount
        // Lets you specify a payment amount.
        // You can also specify additional details
        // such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($credits)
            ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. 
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Credits purchase for LineBlocs.com")
            ->setInvoiceNumber(uniqid());

        // ### Redirect urls
        // Set the urls that the buyer must be redirected to after 
        // payment approval/ cancellation.

        $amountInCents = MainHelper::toCents($credits);
        $credit = [
          'cents' => $amountInCents,
          'card_id' => NULL,
          'user_id' => $user->id,
          'source' => 'PAYPAL',
          'status' => 'pending'
        ];
        $creditObj = UserCredit::create($credit);
        $params = '?creditId='.$creditObj->id;
        $params .= '?userId='.$user->id;
        $success = app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('checkout_paypal_done').$params;
        $fail  = app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('checkout_paypal_fail').$params;
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($success)
            ->setCancelUrl($fail);

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent set to 'sale'
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        // For Sample Purposes Only.
        $request = clone $payment;
        $apiContext = MainHelper::getPayPalContext();
        // ### Create Payment
        // Create a payment by calling the 'create' method
        // passing it a valid apiContext.
        // (See bootstrap.php for more on `ApiContext`)
        // The return object contains the state and the
        // url to which the buyer must be redirected to
        // for payment approval
        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
          Log::info("PayPal error: " . $ex->getMessage());
          Log::info($ex->getTraceAsString());
          return $this->errorInternal($request, 'PayPal error');
        }

        // ### Get redirect url
        // The API response provides the url that you must redirect
        // the buyer to. Retrieve the url from the $payment->getApprovalLink()
        // method
        $approvalUrl = $payment->getApprovalLink();
        return $this->response->array(['url' => $approvalUrl]);
  }
  public function checkoutWithPayPalDone(Request $request)
    {
      // ### Approval Status
      // Determine if the user approved the payment or not
      $apiContext = MainHelper::getPayPalContext();
      if (isset($_GET['paymentId'])) {

          // Get the payment Object by passing paymentId
          // payment id was previously stored in session in
          // CreatePaymentUsingPayPal.php
          $paymentId = $_GET['paymentId'];
          $payment = Payment::get($paymentId, $apiContext);
          // ### Payment Execute
          // PaymentExecution object includes information necessary
          // to execute a PayPal account payment.
          // The payer_id is added to the request query parameters
          // when the user is redirected from paypal back to your site
          $execution = new PaymentExecution();
          $execution->setPayerId($_GET['PayerID']);
          // ### Optional Changes to Amount
          // If you wish to update the amount that you wish to charge the customer,
          // based on the shipping address or any other reason, you could
          // do that by passing the transaction object with just `amount` field in it.
          // Here is the example on how we changed the shipping to $1 more than before.
          /*
          $transaction = new Transaction();
          $amount = new Amount();
          $details = new Details();
          $details->setShipping(2.2)
              ->setTax(1.3)
              ->setSubtotal(17.50);
          $amount->setCurrency('USD');
          $amount->setTotal(21);
          $amount->setDetails($details);
          $transaction->setAmount($amount);
          // Add the above transaction object inside our Execution object.
          $execution->addTransaction($transaction);
          */
          // Execute the payment
          // (See bootstrap.php for more on `ApiContext`)
          $result = $payment->execute($execution, $apiContext);
          // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
          $creditObj = UserCredit::findOrFail($_REQUEST['creditId']);
          $creditObj->update([ 'status' => 'approved' ]);
          $userObj = User::findOrFail($_REQUEST['userId']);
          $userObj->update([
            'linked_paypal' => TRUE
          ]);
          $payment = Payment::get($paymentId, $apiContext);
          return redirect("/back-to-billing");
      } else {
          // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
          return redirect("/back-to-billing-cancel");
          //exit;
      }
  }
  public function checkoutWithPayPalFail(Request $request)
    {
          return redirect("/back-to-billing-cancel");
  }

}

