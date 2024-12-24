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
        $array = $supportTicket->toArray();
        $createdAt = $supportTicket['created_at'];
        $updatedAt = $supportTicket['updated_at'];

        $array['friendly_dates'] =[
            'created_at' => MainHelper::createHumanReadableDate($createdAt),
            'updated_at' => MainHelper::createHumanReadableDate($updatedAt),
        ];
        return $array;
    }
}
