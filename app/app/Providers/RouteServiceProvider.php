<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use \App\User;
use \App\PortNumber;
use \App\DIDNumber;
use \App\SIPProvider;
use \App\SIPProviderHost;
use \App\SIPProviderRate;
use \App\DNSRecord;
use \App\ServicePlan;
use \App\WorkspaceRoutingFlow;
use \App\SIPProviderWhitelistIp;
use \App\SIPRouter;
use \App\SIPRouterMediaServer;
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
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
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
       \Route::model('server', MediaServer::class);
       \Route::model('rate', CallRate::class);
       \Route::model('country', SIPCountry::class);
       \Route::model('region', SIPRegion::class);
       \Route::model('center', SIPRateCenter::class);
       \Route::model('systemstatus', SystemStatusCategory::class);
       \Route::model('errortrace', ErrorUserTrace::class);
       \Route::model('number', NumberInventory::class);
       \Route::model('routerflow', RouterFlow::class);
       \Route::model('rtpproxy', RTPProxy::class);
       \Route::model('workspaceflow', WorkspaceRoutingFlow::class);
       \Route::model('trunk', SIPTrunk::class);
       \Route::model('dns', DNSRecord::class);
       \Route::model('serviceplan',ServicePlan::class);

       \Route::model('resourcearticle',ResourceArticle::class);
       \Route::model('resourcesection',ResourceSection::class);
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

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
