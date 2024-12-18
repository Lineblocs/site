<?php

namespace App\Http\Controllers\Api\Card;

use App\Helpers\MainHelper;
use \App\Http\Controllers\Api\ApiAuthController;
use \App\Http\Controllers\Api\HasStripeController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\UserCard;
use \App\Transformers\UserCardTransformer;
use Log;



class CardController extends HasStripeController {

    public function addCard(Request $request)
    {
        $data = $request->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        try {
            $card = MainHelper::addCard($data, $user, $workspace);
        } catch (Exception $ex) {
            Log::error("error while processing new user card: " . $ex->getMessage());
            return $this->errorInternal($request, 'Stripe card process error');
        }

        MainHelper::makeCardPrimary($card, $user, $workspace);
        return $this->response->noContent()->withHeader('X-Card-ID', $card->id);
    }
    public function setPrimary(Request $request, $cardId)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $card = UserCard::findOrFail($cardId);
        MainHelper::makeCardPrimary($card, $user, $workspace);
        return $this->response->noContent();

    }

    public function listCards(Request $request)
    {
        $user = $this->getUser($request);
        $cards = UserCard::where('user_id', $user->id)->get();
        return $this->response->collection($cards, new UserCardTransformer);
    }

    private function removePaymentMethod($paymentMethodId) {
        // First, retrieve the payment method
        $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);
        
        // Detach it from the customer
        $paymentMethod->detach();
        
        return TRUE;
    }
    public function deleteCard(Request $request, $cardId)
    {
        $card = UserCard::findOrFail($cardId);
        $workspace = $this->getWorkspace($request);
        $user = $this->getUser($request);
        //if (!$this->hasPermissions($request, $card, 'manage_billing')) {
        if (TRUE) {
            Log::info(sprintf("removing card: %s", $card->id));
            try {
                MainHelper::removePaymentMethod($workspace, $card);
            } catch (Exception $ex) {
                Log::error("error while processing new user card: " . $ex->getMessage());
                return $this->errorInternal($request, 'Error deleting card..');
            }
            $card->delete();
            return $this->response->noContent();
        }
       
    }
}

