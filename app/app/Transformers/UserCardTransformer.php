<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\UserCard;

final class UserCardTransformer extends TransformerAbstract {
     public function transform(UserCard $card)
    {
        $array = $card->toArray();
        return $array;
    }
}
