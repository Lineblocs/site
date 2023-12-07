<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\SupportTicket;
use App\Helpers\MainHelper;

final class SupportTicketTransformer extends TransformerAbstract {
     public function transform(SupportTicket $supportTicket)
    {
        $supportTicket->toArray();
        return $array;
    }
}
