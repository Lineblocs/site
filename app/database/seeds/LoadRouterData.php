<?php

use Illuminate\Database\Seeder;
use App\SIPRouter;
use App\RTPProxy;
use App\SIPRouterHelper;

class LoadRouterData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $primaryRouter = SIPouter::all()[0];
        $proxy = RTPProxy::create([
            'rtpproxy_sock' => '127.0.0.1',
            'router_id' => $primaryRouter->id,
            'set_id' => '1',
            'priority' => '1'
        ]);
        SIPRouterHelper::addRTPProxy($proxy->id,$proxy->rtpproxy_sock);
    }
}
