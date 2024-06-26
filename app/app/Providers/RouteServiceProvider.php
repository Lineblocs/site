<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use \App\User;
use \App\PortNumber;
use \App\DIDNumber;
use \App\SIPProvider;
use \App\SIPProviderHost;
use \App\SIPProviderRate;
use \App\SIPPoPRegion;
use \App\DNSRecord;
use \App\ServicePlan;
use \App\Workspace;
use \App\WorkspaceRoutingFlow;
use \App\SIPProviderWhitelistIp;
use \App\SIPRouter;
use \App\SIPRouterMediaServer;
use \App\SIPRouterDigitMapping;
use \App\MediaServer;
use \App\CallRate;
use App\ErrorUserTrace;
use \App\SIPCountry;
use \App\SIPRegion;
use \App\SIPRateCenter;
use \App\RTPProxy;
use \App\SystemStatusCategory;
use \App\NumberInventory;
use \App\RouterFlow;
use \App\SIPTrunk;
use \App\SIPTrunkOrigination;
use \App\SIPTrunkOriginationEndpoint;
use \App\SIPTrunkTermination;
use \App\ResourceSection;
use \App\ResourceArticle;
use \App\CompanyRepresentative;
use \App\SIPRoutingACL;
use \App\Competitor;
use \App\CostSaving;
use \App\NumberService;
use \App\SupportTicket;
use \App\SupportTicketCategory;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
       \Route::model('user', User::class);
       \Route::model('port', PortNumber::class);
       \Route::model('did', DIDNumber::class);
       \Route::model('provider', SIPProvider::class);
       \Route::model('host', SIPProviderHost::class);
       \Route::model('providerRate', SIPProviderRate::class);
       \Route::model('ip', SIPProviderWhitelistIp::class);
       \Route::model('router', SIPRouter::class);
       \Route::model('routerServer', SIPRouterMediaServer::class);
       \Route::model('digitMapping', SIPRouterDigitMapping::class);
       \Route::model('server', MediaServer::class);
       \Route::model('rate', CallRate::class);
       \Route::model('country', SIPCountry::class);
       \Route::model('region', SIPRegion::class);
       \Route::model('popregion', SIPPoPRegion::class);
       \Route::model('center', SIPRateCenter::class);
       \Route::model('systemstatus', SystemStatusCategory::class);
       \Route::model('errortrace', ErrorUserTrace::class);
       \Route::model('numberinventory', NumberInventory::class);
       \Route::model('routerflow', RouterFlow::class);
       \Route::model('rtpproxy', RTPProxy::class);
       \Route::model('workspace', Workspace::class);
       \Route::model('workspaceflow', WorkspaceRoutingFlow::class);
       \Route::model('trunk', SIPTrunk::class);
       \Route::model('dns', DNSRecord::class);
       \Route::model('serviceplan',ServicePlan::class);

       \Route::model('resourcearticle',ResourceArticle::class);
       \Route::model('resourcesection',ResourceSection::class);

       \Route::model('companyrepresentative',CompanyRepresentative::class);
       \Route::model('routingacl',SIPRoutingACL::class);
       \Route::model('competitor',Competitor::class);
       \Route::model('costsaving',CostSaving::class);
       \Route::model('numberservice',NumberService::class);
       \Route::model('supportticket',SupportTicket::class);
       \Route::model('supportticketcategory',SupportTicketCategory::class);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
