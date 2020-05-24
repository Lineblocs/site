<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use \App\User;
use \App\PortNumber;
use \App\SIPProvider;
use \App\SIPProviderHost;
use \App\SIPProviderWhitelistIp;
use \App\CallRate;
use App\ErrorUserTrace;
use \App\SIPCountry;
use \App\SIPRegion;
use \App\SIPRateCenter;
use \App\SystemStatusCategory;
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
       \Route::model('provider', SIPProvider::class);
       \Route::model('host', SIPProviderHost::class);
       \Route::model('ip', SIPProviderWhitelistIp::class);
       \Route::model('rate', CallRate::class);
       \Route::model('country', SIPCountry::class);
       \Route::model('region', SIPRegion::class);
       \Route::model('center', SIPRateCenter::class);
       \Route::model('systemstatus', SystemStatusCategory::class);
       \Route::model('errortrace', ErrorUserTrace::class);
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
