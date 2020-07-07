<?php

namespace App\Http\Controllers\Api\Card;
use \App\Http\Controllers\Api\ApiAuthController;
use \App\Http\Controllers\Api\HasStripeController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\UserCard;
use \App\Transformers\UserCardTransformer;



class CardController extends HasStripeController {
    public function initStripe() {
        $stripe = \Config::get("stripe");
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
    }

    public function addCard(Request $request)
    {
        $this->initStripe();
        $data = $request->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        try {
            $card = \Stripe\Customer::createSource(
                $user->stripe_id,
                [
                    'source' => $data['stripe_token']
                ]
            );
        } catch (Exception $ex) {
            Log::error("error while processing new user card: " . $ex->getMessage());
            return $this->errorInternal($request, 'Stripe card process error');
        }
        $all = UserCard::where('workspace_id', $workspace->id)->get();
        $params = [
            'last_4' => $data['last_4'],
            'stripe_id' => $card->id,
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'issuer' => $card->brand
        ];
        if ( count( $all ) == 0 ) { // set first as primary
            $params['primary']=TRUE;
        }
        $card = UserCard::create($params);
        return $this->response->noContent()->withHeader('X-Card-ID', $card->id);
    }
    public function setPrimary(Request $request, $cardId)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $cards = UserCard::where('workspace_id', $workspace->id)->get();
        foreach ($cards as $card) {
            $card->update(['primary' => FALSE]);
        }
        $card = UserCard::findOrFail($cardId);
        $card->update(['primary' => TRUE]);
        return $this->response->noContent();

    }

    public function listCards(Request $request)
    {
        $user = $this->getUser($request);
        $cards = UserCard::where('user_id', $user->id)->get();
        return $this->response->collection($cards, new UserCardTransformer);
    }
    public function deleteCard(Request $request, $cardId)
    {
        $card = UserCard::firstOrFail($cardId);
        if (!$this->hasPermissions($request, $card, 'manage_billing')) {
            try {
                \Stripe\Customer::deleteSource(
                $user->stripe_id,
                $card->stripe_id
                );

            } catch (Exception $ex) {
                Log::error("error while processing new user card: " . $ex->getMessage());
                return $this->errorInternal($request, 'Error deleting card..');
            }
            $card->delete();
            return $this->response->noContent();
        }
       
    }
}

