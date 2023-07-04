<?php
/****************   Model binding into route **************************/
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[0-9a-z-_]+');
/***************    Site routes  **********************************/


Route::get('/', 'HomeController@index');
Route::get('healthz', 'HealthzController@healthz');
Route::group(['prefix' => 'setup', 'middleware' => '\App\Http\Middleware\Setup'], function() {
  Route::get('', 'SetupController@setup');
  Route::get('restart', 'SetupController@setup_restart');
  Route::get('storage', 'SetupController@setup_storage');
  Route::post('storage', 'SetupController@save_storage');
  Route::get('tts', 'SetupController@setup_tts');
  Route::post('tts', 'SetupController@save_tts');
  Route::get('payments', 'SetupController@setup_payments');
  Route::post('payments', 'SetupController@save_payments');
  Route::get('smtp', 'SetupController@setup_smtp');
  Route::post('smtp', 'SetupController@save_smtp');
  Route::get('admin', 'SetupController@setup_admin');
  Route::post('admin', 'SetupController@save_admin');

  Route::get('customization', 'SetupController@setup_customization');
  Route::post('customization', 'SetupController@save_customization');
  route::get('customization', 'SetupController@setup_customization');
  route::post('customization', 'SetupController@save_customization');
  Route::get('complete', 'SetupController@setup_complete');
  Route::get('alreadycomplete', 'SetupController@setup_alreadycomplete');
});

  Route::get('404', 'HomeController@notfound_404')->name('404');
Route::get('home', 'HomeController@index');
Route::get('about', 'HomeController@about');
Route::get('contact', 'HomeController@contact');
Route::get('quote', 'HomeController@requestQuote');
Route::post('quote', 'HomeController@requestQuoteSubmit');
Route::post('contactSubmit', 'HomeController@contactSubmit');
Route::get('login', 'HomeController@login');
Route::get('pricing', 'HomeController@pricing');
Route::get('rates', 'HomeController@rates1');
Route::get('rates/{countryId}', 'HomeController@rates');
Route::get('faqs', 'HomeController@faqs');
Route::get('/pages/privacy-policy', 'PagesController@privacyPolicy');
Route::get('/pages/tos', 'PagesController@termsOfService');
Route::get('/resources', 'ResourcesController@index');
Route::get('/resources/article-inactive', 'ResourcesController@articleInactive');
Route::get('/resources/{section}', 'ResourcesController@section');
Route::get('/resources/{section}/{item}', 'ResourcesController@sectionItem');
Route::get('/features', 'HomeController@features');
Route::get('/features/call-flow-builder', 'HomeController@flowbuilder_features');
Route::get('/features/did-manage', 'HomeController@didnumbers_features');
Route::get('/features/pops', 'HomeController@pops_features');
Route::get('/solutions/cloud-native', 'HomeController@cloud_native_solutions');
Route::get('/register', 'HomeController@register');
Route::post('/register', 'HomeController@registerSubmit');
Route::get('/register/2', 'HomeController@register2');
Route::post('/register/2', 'HomeController@register2Submit');
Route::get('/register/3', 'HomeController@register3');
Route::post('/register/3', 'HomeController@register3Submit');
Route::get('/register/4', 'HomeController@register4');
Route::post('/register/4', 'HomeController@register4Submit');
Route::get('/register/5', 'HomeController@register5');
Route::post('/register/5', 'HomeController@register5Submit');


Route::get('/back-to-billing', 'HomeController@backToBilling');
Route::get('/back-to-billing-cancel', 'HomeController@backToBillingCancel');
Route::get('/email-verify', 'HomeController@emailVerify')->name('email-verify');
Route::get('/alternative', 'HomeController@alternative');
Route::post('/alternative', 'HomeController@alternativeSubmit');
Route::get('/alternative/ringcentral', 'HomeController@alternative_ringcentral');
Route::get('/alternative/nextiva', 'HomeController@alternative_nextiva');
Route::get('/alternative/dialpad', 'HomeController@alternative_dialpad');
Route::get('/alternative/grasshopper', 'HomeController@alternative_grasshopper');
Route::get('/ucaas/', 'HomeController@ucaas');
Route::get('/ucaas/{countryId}', 'HomeController@ucaas_country');
Route::get('/ucaas/{countryId}/{regionId}', 'HomeController@ucaas_services');

Route::get('/status', 'HomeController@status');
Route::get('/status/{categoryId}', 'HomeController@status_category');
Route::get('/status/{categoryId}/{updateId}', 'HomeController@status_update');
//Route::post('jwt/authenticate', '\App\Http\Controllers\JWT\AuthenticateController@authenticate');
Route::get('generateMonthlyInvoice', '\App\Http\Controllers\BillingController@generateMonthlyInvoice');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
/***************    Admin routes  **********************************/
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {

    # Admin Dashboard
    Route::get('dashboard', 'Admin\DashboardController@index');

    # Users
    Route::get('user/data', 'Admin\UserController@data');
    Route::get('user/{workspaceflow}/flow', 'Admin\UserController@edit_flow');
    Route::get('user/createFlowForCountry','Admin\UserController@create_flow_for_country');
    Route::get('user/{user}/show', 'Admin\UserController@show');
    Route::get('user/{user}/edit', 'Admin\UserController@edit');
    Route::get('user/{user}/delete', 'Admin\UserController@delete');
    Route::post('user/{user}/send_email', 'Admin\UserController@send_email');
    Route::get('user/{user}/port/{port}/edit', 'Admin\UserController@edit_port_req');
    Route::put('user/{user}/port/{port}/edit', 'Admin\UserController@edit_port_req_do');
    Route::get('user/{user}/did/{did}/edit', 'Admin\UserController@edit_did');
    Route::put('user/{user}/did/{did}/edit', 'Admin\UserController@edit_did_do');
    Route::resource('user', 'Admin\UserController');
    Route::resource('port', 'Admin\UserController');
    Route::resource('did', 'Admin\UserController');

    # Workspaces
    Route::get('workspace/data', 'Admin\WorkspaceController@data');
    Route::get('workspace/{workspace}/show', 'Admin\WorkspaceController@show');
    Route::get('workspace/{workspace}/edit', 'Admin\WorkspaceController@edit');
    Route::get('workspace/{workspace}/delete', 'Admin\WorkspaceController@delete');
    Route::resource('workspace', 'Admin\WorkspaceController');

    # SIPProviders
    Route::get('provider/data', 'Admin\SIPProviderController@data');
    Route::get('provider/{provider}/show', 'Admin\SIPProviderController@show');
    Route::get('provider/{provider}/edit', 'Admin\SIPProviderController@edit');
    Route::get('provider/{provider}/delete', 'Admin\SIPProviderController@delete');
    Route::resource('provider', 'Admin\SIPProviderController');



     # CallRates
    Route::get('rate/data', 'Admin\CallRateController@data');
    Route::get('rate/{rate}/show', 'Admin\CallRateController@show');
    Route::get('rate/{rate}/edit', 'Admin\CallRateController@edit');
    Route::get('rate/{rate}/delete', 'Admin\CallRateController@delete');
    Route::resource('rate', 'Admin\CallRateController');


    Route::get('routerflow/data', 'Admin\RouterFlowController@data');
    Route::post('routerflow/show', 'Admin\RouterFlowController@show');
    Route::get('routerflow/{routerflow}/edit', 'Admin\RouterFlowController@edit');
    Route::put('routerflow/{routerflow}/delete', 'Admin\RouterFlowController@delete');
    Route::resource('routerflow', 'Admin\RouterFlowController');

    # SIPProviders
    Route::get('provider/data', 'Admin\SIPProviderController@data');
    Route::get('provider/{provider}/show', 'Admin\SIPProviderController@show');
    Route::get('provider/{provider}/edit', 'Admin\SIPProviderController@edit');
    Route::get('provider/{provider}/delete', 'Admin\SIPProviderController@delete');
    Route::get('provider/{provider}/add_host', 'Admin\SIPProviderController@add_host');
    Route::post('provider/{provider}/add_host', 'Admin\SIPProviderController@add_host_save');
    Route::get('provider/{provider}/edit_host/{host}', 'Admin\SIPProviderController@edit_host');
    Route::post('provider/{provider}/edit_host/{host}', 'Admin\SIPProviderController@edit_host_save');
    Route::put('provider/{provider}/edit_host/{host}', 'Admin\SIPProviderController@edit_host_save');
    Route::post('provider/{provider}/del_host/{host}', 'Admin\SIPProviderController@del_host');

    Route::get('provider/{provider}/add_rate', 'Admin\SIPProviderController@add_rate');
    Route::post('provider/{provider}/add_rate', 'Admin\SIPProviderController@add_rate_save');
    Route::get('provider/{provider}/edit_rate/{providerRate}', 'Admin\SIPProviderController@edit_rate');
    Route::post('provider/{provider}/edit_rate/{providerRate}', 'Admin\SIPProviderController@edit_rate_save');
    Route::put('provider/{provider}/edit_rate/{providerRate}', 'Admin\SIPProviderController@edit_rate_save');
    Route::post('provider/{provider}/del_rate/{providerRate}', 'Admin\SIPProviderController@del_rate');

    Route::get('provider/{provider}/add_ip', 'Admin\SIPProviderController@add_ip');
    Route::post('provider/{provider}/add_ip', 'Admin\SIPProviderController@add_ip_save');
    Route::get('provider/{provider}/edit_ip/{ip}', 'Admin\SIPProviderController@edit_ip');
    Route::post('provider/{provider}/edit_ip/{ip}', 'Admin\SIPProviderController@edit_ip_save');
    Route::put('provider/{provider}/edit_ip/{ip}', 'Admin\SIPProviderController@edit_ip_save');
    Route::post('provider/{provider}/del_ip/{ip}', 'Admin\SIPProviderController@del_ip');

    Route::resource('provider', 'Admin\SIPProviderController');
    Route::resource('host', 'Admin\SIPProviderController');



    # SIPTrunks
    Route::get('trunk/data', 'Admin\SIPTrunkController@data');
    Route::get('trunk/{trunk}/show', 'Admin\SIPTrunkController@show');
    Route::get('trunk/{trunk}/edit', 'Admin\SIPTrunkController@edit');
    Route::get('trunk/{trunk}/delete', 'Admin\SIPTrunkController@delete');
    Route::resource('trunk', 'Admin\SIPTrunkController');
    //Route::resource('orig', 'Admin\SIPTrunkController');
    //Route::resource('termination', 'Admin\SIPTrunkController');


    # SIPRouters
    Route::get('router/data', 'Admin\SIPRouterController@data');
    Route::get('router/{router}/show', 'Admin\SIPRouterController@show');
    Route::get('router/{router}/edit', 'Admin\SIPRouterController@edit');
    Route::get('router/{router}/delete', 'Admin\SIPRouterController@delete');
    Route::get('router/{router}/add_server', 'Admin\SIPRouterController@add_server');
    Route::post('router/{router}/add_server', 'Admin\SIPRouterController@add_server_save');
    Route::get('router/{router}/edit_server/{routerServer}', 'Admin\SIPRouterController@edit_server');
    Route::post('router/{router}/del_server/{routerServer}', 'Admin\SIPRouterController@del_server');
    Route::resource('router', 'Admin\SIPRouterController');
    Route::resource('routerServer', 'Admin\SIPRouterController');

    # company reps
    Route::get('companyrepresentative/data', 'Admin\CompanyRepresentativeController@data');
    Route::get('companyrepresentative/{companyrepresentative}/show', 'Admin\CompanyRepresentativeController@show');
    Route::get('companyrepresentative/{companyrepresentative}/edit', 'Admin\CompanyRepresentativeController@edit');
    Route::get('companyrepresentative/{companyrepresentative}/delete', 'Admin\CompanyRepresentativeController@delete');
    Route::resource('companyrepresentative', 'Admin\CompanyRepresentativeController');



    # DNSRecords
    Route::get('dns/data', 'Admin\DNSRecordController@data');
    Route::get('dns/{dns}/show', 'Admin\DNSRecordController@show');
    Route::get('dns/{dns}/edit', 'Admin\DNSRecordController@edit');
    Route::get('dns/{dns}/delete', 'Admin\DNSRecordController@delete');
    Route::resource('dns', 'Admin\DNSRecordController');


    # MediaServers
    Route::get('server/data', 'Admin\MediaServerController@data');
    Route::get('server/{server}/show', 'Admin\MediaServerController@show');
    Route::get('server/{server}/edit', 'Admin\MediaServerController@edit');
    Route::get('server/{server}/delete', 'Admin\MediaServerController@delete');
    Route::resource('server', 'Admin\MediaServerController');

    # RTPProxys
    Route::get('rtpproxy/data', 'Admin\RTPProxyController@data');
    Route::get('rtpproxy/{rtpproxy}/show', 'Admin\RTPProxyController@show');
    Route::get('rtpproxy/{rtpproxy}/edit', 'Admin\RTPProxyController@edit');
    Route::get('rtpproxy/{rtpproxy}/delete', 'Admin\RTPProxyController@delete');
    Route::resource('rtpproxy', 'Admin\RTPProxyController');


    # NumberInventorys
    Route::get('number/data', 'Admin\NumberInventoryController@data');
    Route::get('number/{number}/show', 'Admin\NumberInventoryController@show');
    Route::get('number/{number}/edit', 'Admin\NumberInventoryController@edit');
    Route::get('number/{number}/delete', 'Admin\NumberInventoryController@delete');
    Route::get('number/import', 'Admin\NumberInventoryController@import');
    Route::post('number/import', 'Admin\NumberInventoryController@import_save');
    Route::resource('number', 'Admin\NumberInventoryController');


     # SIPCountrys
    Route::get('country/data', 'Admin\SIPCountryController@data');
    Route::get('country/{country}/flow', 'Admin\SIPCountryController@edit_flow');
    Route::get('country/{country}/add_region', 'Admin\SIPCountryController@add_region');
    Route::post('country/{country}/add_region', 'Admin\SIPCountryController@add_region_save');
    Route::get('country/{country}/add_region/{region}', 'Admin\SIPCountryController@add_region_edit');
    Route::post('country/{country}/add_region/{region}', 'Admin\SIPCountryController@add_region_edit_save');
    Route::post('country/{country}/del_region/{region}', 'Admin\SIPCountryController@del_region');
    Route::put('country/{country}/add_region/{region}', 'Admin\SIPCountryController@add_region_edit_save');
    Route::get('country/{country}/region/{region}/add_ratecenter', 'Admin\SIPCountryController@add_ratecenter');
    Route::post('country/{country}/region/{region}/add_ratecenter', 'Admin\SIPCountryController@add_ratecenter_save');
    Route::get('country/{country}/region/{region}/add_ratecenter/{center}', 'Admin\SIPCountryController@add_ratecenter_edit');
    Route::post('country/{country}/region/{region}/add_ratecenter/{center}', 'Admin\SIPCountryController@add_ratecenter_edit_save');
    Route::put('country/{country}/region/{region}/add_ratecenter/{center}', 'Admin\SIPCountryController@add_ratecenter_edit_save');

    Route::put('country/{country}/region/{region}/add_ratecenter', 'Admin\SIPCountryController@add_ratecenter_edit');
    Route::post('country/{country}/region/{region}/del_ratecenter/{center}', 'Admin\SIPCountryController@del_ratecenter');
    Route::get('country/{country}/show', 'Admin\SIPCountryController@show');
    Route::get('country/{country}/edit', 'Admin\SIPCountryController@edit');
    Route::get('country/{country}/delete', 'Admin\SIPCountryController@delete');    
    Route::resource('country', 'Admin\SIPCountryController');
    Route::resource('region', 'Admin\SIPCountryController');


     # ServicePlans
    Route::get('serviceplan/data', 'Admin\ServicePlanController@data');
    Route::get('serviceplan/{serviceplan}/show', 'Admin\ServicePlanController@show');
    Route::get('serviceplan/{serviceplan}/edit', 'Admin\ServicePlanController@edit');
    Route::get('serviceplan/{serviceplan}/delete', 'Admin\ServicePlanController@delete');
    Route::resource('serviceplan', 'Admin\ServicePlanController');


    # SIPRoutingACL
    Route::get('routingacl/data', 'Admin\SIPRoutingACLController@data');
    Route::get('routingacl/{routingacl}/show', 'Admin\SIPRoutingACLController@show');
    Route::get('routingacl/{routingacl}/edit', 'Admin\SIPRoutingACLController@edit');
    Route::get('routingacl/{routingacl}/delete', 'Admin\SIPRoutingACLController@delete');
    Route::resource('routingacl', 'Admin\SIPRoutingACLController');

     # ResourceSections
    Route::get('resourcesection/data', 'Admin\ResourceSectionController@data');
    Route::get('resourcesection/{resourcesection}/show', 'Admin\ResourceSectionController@show');
    Route::get('resourcesection/{resourcesection}/edit', 'Admin\ResourceSectionController@edit');
    Route::get('resourcesection/{resourcesection}/delete', 'Admin\ResourceSectionController@delete');
    Route::resource('resourcesection', 'Admin\ResourceSectionController');

     # ResourceArticles
    Route::get('resourcearticle/data', 'Admin\ResourceArticleController@data');
    Route::get('resourcearticle/{resourcearticle}/show', 'Admin\ResourceArticleController@show');
    Route::get('resourcearticle/{resourcearticle}/edit', 'Admin\ResourceArticleController@edit');
    Route::get('resourcearticle/{resourcearticle}/delete', 'Admin\ResourceArticleController@delete');
    Route::resource('resourcearticle', 'Admin\ResourceArticleController');

    # system status
    Route::get('systemstatus/data', 'Admin\SystemStatusController@data');
    Route::get('systemstatus/{systemstatus}/show', 'Admin\SystemStatusController@show');
    Route::get('systemstatus/{systemstatus}/edit', 'Admin\SystemStatusController@edit');
    Route::get('systemstatus/{systemstatus}/delete', 'Admin\SystemStatusController@delete');
    Route::get('systemstatus/{systemstatus}/add_alert', 'Admin\SystemStatusController@add_alert');
    Route::post('systemstatus/{systemstatus}/add_alert', 'Admin\SystemStatusController@add_alert_save');
    Route::resource('systemstatus', 'Admin\SystemStatusController');

    # system status
    Route::get('errortrace/data', 'Admin\ErrorTraceController@data');
    Route::get('errortrace/{errortrace}/show', 'Admin\ErrorTraceController@show');
    Route::get('errortrace/{errortrace}/edit', 'Admin\ErrorTraceController@edit');
    Route::get('errortrace/{errortrace}/delete', 'Admin\ErrorTraceController@delete');
    Route::resource('errortrace', 'Admin\ErrorTraceController');



    Route::get('settings', 'Admin\SettingsController@view');
    Route::post('settings', 'Admin\SettingsController@save');


    Route::get('customizations', 'Admin\CustomizationsController@view');
    Route::post('customizations', 'Admin\CustomizationsController@save');

    Route::get('faqs', 'Admin\FAQsController@view');
    Route::post('faqs', 'Admin\FAQsController@save');
});
// API routes
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function($api) {
  $api->group(['prefix' => 'v1'], function ($api) { // Use this route group for v1
    $api->group([ 'prefix' => 'public', 'namespace' => '\App\Http\Controllers\Api\PublicAPI'], function($api) {

      /** /list route should be before /{id} route to avoid conflicts.. **/
      $api->group([ 'prefix' => 'did', 'namespace' => '\DIDNumber'], function($api) {
          $api->get("/searchAvailable", "DIDNumberController@searchAvailable");
          $api->get("/list", "DIDNumberController@list");
          $api->get("/{didId}", "DIDNumberController@get");
          $api->post("/", "DIDNumberController@post");
          $api->post("/{didId}", "DIDNumberController@put");
          $api->delete("/{didId}", "DIDNumberController@delete");
      });
      $api->group([ 'prefix' => 'extension', 'namespace' => '\Extension'], function($api) {
          $api->get("/list", "ExtensionController@list");
          $api->get("/{extensionId}", "ExtensionController@get");
          $api->post("/", "ExtensionController@post");
          $api->post("/{extensionId}", "ExtensionController@put");
          $api->delete("/{extensionId}", "ExtensionController@delete");
      });
      $api->group([ 'prefix' => 'user', 'namespace' => '\User'], function($api) {
          $api->post("/createUser", "UserController@createUser");
          $api->post("/validateLogin", "UserController@validateLogin");
          $api->post("/requestLoginToken", "UserController@requestLoginToken");
          $api->post("/forgotPassword", "UserController@forgotPassword");
          $api->get("/list", "UserController@list");

          $api->get("/{userId}", "UserController@get");
          $api->post("/update", "UserController@post");
          $api->post("/update/{userId}", "UserController@put");
          $api->delete("/{userId}", "UserController@delete");
      });
      $api->group([ 'prefix' => 'blocked', 'namespace' => '\BlockedNumber'], function($api) {
          $api->get("/list", "BlockedNumberController@list");
          $api->get("/{blockedId}", "BlockedNumberController@get");
          $api->post("/", "BlockedNumberController@post");
          $api->post("/{blockedId}", "BlockedNumberController@put");
          $api->delete("/{blockedId}", "BlockedNumberController@delete");
      });
      $api->group([ 'prefix' => 'recording', 'namespace' => '\Recording'], function($api) {
          $api->get("/list", "RecordingController@list");
          $api->get("/{recordingId}", "RecordingController@get");
          $api->post("/", "RecordingController@post");
          $api->post("/{recordingId}", "RecordingController@put");
          $api->delete("/{recordingId}", "RecordingController@delete");
      });
      $api->group([ 'prefix' => 'call', 'namespace' => '\Call'], function($api) {
          $api->get("/reports", "CallController@getReports");
          $api->get("/list", "CallController@list");
          $api->get("/{callId}", "CallController@get");
          $api->post("/", "CallController@post");
          $api->post("/{callId}", "CallController@put");
          $api->delete("/{callId}", "CallController@delete");
      });
      $api->group([ 'prefix' => 'byo', 'namespace' => '\BYO'], function($api) {
        $api->group([ 'prefix' => 'did', 'namespace' => '\DIDNumber'], function($api) {
            $api->get("/list", "DIDNumberController@list");
            $api->get("/{didId}", "DIDNumberController@get");
            $api->post("/", "DIDNumberController@post");
            $api->put("/{didId}", "DIDNumberController@put");
            $api->delete("/{didId}", "DIDNumberController@delete");
        });
      });
      $api->group([ 'prefix' => 'trunk', 'namespace' => '\SIPTrunk'], function($api) {
          $api->get("/list", "SIPTrunkController@listTrunks");
          $api->get("/{trunkId}", "SIPTrunkController@trunkData");
          $api->post("/", "SIPTrunkController@saveTrunk");
          $api->post("/{trunkId}", "SIPTrunkController@updateTrunk");
          $api->delete("/{trunkId}", "SIPTrunkController@deleteTrunk");
      });

    });
  });
  $api->group(['prefix' => 'v1'], function ($api) { // Use this route group for v1
    $api->group([ 'prefix' => 'setup'], function($api) {
      $api->get('getSettings', '\App\Http\Controllers\Api\SetupController@getSettings');
      $api->post('saveSettings', '\App\Http\Controllers\Api\SetupController@saveSettings');
    });
    $api->group([ 'prefix' => 'admin'], function($api) {
      $api->get('getWorkspaces', '\App\Http\Controllers\Api\AdminController@getWorkspaces');
    });

    $api->post('internalAppRedirect', '\App\Http\Controllers\MergedController@internalAppRedirect');
    $api->get('getAllSettings', '\App\Http\Controllers\MergedController@getAllSettings');
    $api->get('getServicePlans', '\App\Http\Controllers\MergedController@getServicePlans');

    $api->group([ 'prefix' => 'jwt'], function($api) {
      $api->post('authenticate', '\App\Http\Controllers\JWT\AuthenticateController@authenticate');
      $api->post('publicAuthenticate', '\App\Http\Controllers\JWT\AuthenticateController@authenticatePublic');
      $api->get('heartbeat', '\App\Http\Controllers\JWT\AuthenticateController@heartbeat');
    });

    $api->group([ 'prefix' => 'account'], function($api) {
      $api->post('forgotPassword', '\App\Http\Controllers\RegisterController@forgot');
      $api->post('resetPassword', '\App\Http\Controllers\RegisterController@reset');
    });

    $api->post('register', '\App\Http\Controllers\RegisterController@register');
    $api->post('registerSendVerify', '\App\Http\Controllers\RegisterController@registerSendVerify');
    $api->post('registerVerify', '\App\Http\Controllers\RegisterController@registerVerify');
    $api->post('registerVerifyHook', '\App\Http\Controllers\RegisterController@registerVerifyHook');
    $api->post('userSpinup', '\App\Http\Controllers\RegisterController@userSpinup');
    $api->post('provisionCallSystem', '\App\Http\Controllers\RegisterController@provisionCallSystem');
    $api->post('thirdPartyLogin', '\App\Http\Controllers\RegisterController@thirdPartyLogin');
    $api->post('addCard', '\App\Http\Controllers\RegisterController@addCard');
    $api->get('self', '\App\Http\Controllers\RegisterController@getSelf');
    $api->get('workspace', '\App\Http\Controllers\MergedController@getWorkspaceAPI');
    $api->get('getUserInfo', '\App\Http\Controllers\RegisterController@getUserInfo');
    $api->post('updateSelf', '\App\Http\Controllers\RegisterController@updateSelf');
    $api->post('setupWorkspace', '\App\Http\Controllers\RegisterController@setupWorkspace');
    $api->post('updateWorkspace', '\App\Http\Controllers\MergedController@updateWorkspace');
    $api->get('fetchWorkspaceInfo', '\App\Http\Controllers\MergedController@fetchWorkspaceInfo');
    $api->get('search', '\App\Http\Controllers\MergedController@search');
    $api->post('billing/discontinue', '\App\Http\Controllers\MergedController@billingDiscontinue');
    $api->post('billingDiscontinue', '\App\Http\Controllers\MergedController@billingDiscontinue');
    $api->post('save2FASettings', '\App\Http\Controllers\MergedController@save2FASettings');
    $api->get('get2FAConfig', '\App\Http\Controllers\MergedController@get2FAConfig');
    $api->get('request2FACode', '\App\Http\Controllers\MergedController@request2FACode');
    $api->get('request2FAConfirmationCode', '\App\Http\Controllers\MergedController@request2FAConfirmationCode');
    $api->post('verify2FACode', '\App\Http\Controllers\MergedController@verify2FACode');
    $api->get('getCountryList', '\App\Http\Controllers\MergedController@getCountryList');
    $api->get('getBillingCountries', '\App\Http\Controllers\MergedController@getBillingCountries');
    $api->post('saveCustomerPaymentDetails', '\App\Http\Controllers\MergedController@saveCustomerPaymentDetails');
    $api->get('getBillingInfo', '\App\Http\Controllers\BillingController@getBillingInfo');
    $api->get('getBillingHistory', '\App\Http\Controllers\BillingController@getBillingHistory');
    $api->get('downloadBillingHistory', '\App\Http\Controllers\BillingController@downloadBillingHistory');
    $api->get('generateMonthlyInvoice', '\App\Http\Controllers\BillingController@generateMonthlyInvoice');
    $api->post('verifyPasswordStrength', '\App\Http\Controllers\MergedController@verifyPasswordStrength');
    $api->get('generateSecurePassword', '\App\Http\Controllers\MergedController@generateSecurePassword');
    $api->post('changeBillingSettings', '\App\Http\Controllers\BillingController@changeBillingSettings');
    $api->post('addUsageTrigger', '\App\Http\Controllers\BillingController@addUsageTrigger');
    $api->delete('delUsageTrigger/{triggerId}', '\App\Http\Controllers\BillingController@delUsageTrigger');
    $api->get('getCallSystemTemplates', '\App\Http\Controllers\MergedController@getCallSystemTemplates');
    $api->get('getCallRoutingTemplates', '\App\Http\Controllers\MergedController@getCallRoutingTemplates');
    $api->get('getWorkspaceTokens', '\App\Http\Controllers\MergedController@getWorkspaceTokens');
    $api->get('refreshWorkspaceTokens', '\App\Http\Controllers\MergedController@refreshWorkspaceTokens');
    $api->get('getConfig', '\App\Http\Controllers\ConfigController@getConfig');
    $api->get('dashboard', '\App\Http\Controllers\MergedController@dashboard');
    $api->post('upgradePlan', '\App\Http\Controllers\MergedController@upgradePlan');
    $api->get('plans', '\App\Http\Controllers\MergedController@plans');
    $api->get('billing', '\App\Http\Controllers\MergedController@billing');
    $api->post('saveWidget', '\App\Http\Controllers\MergedController@saveWidget');
    $api->post('submitJoinWorkspace', '\App\Http\Controllers\MergedController@submitJoinWorkspace');
    $api->post('acceptWorkspaceInvite', '\App\Http\Controllers\MergedController@acceptWorkspaceInvite');

    $api->get('getCountries', '\App\Http\Controllers\MergedController@getCountries');
    $api->get('getRegions', '\App\Http\Controllers\MergedController@getRegions');
    $api->get('getRateCenters', '\App\Http\Controllers\MergedController@getRateCenters');
    $api->get('getPhoneDefaults', '\App\Http\Controllers\MergedController@getPhoneDefaults');
    $api->get('getPhoneSettingsByCat', '\App\Http\Controllers\MergedController@getPhoneSettingsByCat');
    $api->get('getPhoneIndividualSettingsByCat', '\App\Http\Controllers\MergedController@getPhoneIndividualSettingsByCat');
    $api->get('getDeployInfo', '\App\Http\Controllers\MergedController@getDeployInfo');
    $api->post('startDeploy', '\App\Http\Controllers\MergedController@startDeploy');

    $api->post('deleteAll', '\App\Http\Controllers\MergedController@deleteAll');
    $api->post('upgradeMembership', '\App\Http\Controllers\MergedController@upgradeMembership');


    $api->get('getFlowPresets', '\App\Http\Controllers\MergedController@getFlowPresets');

    $api->post('saveUpdatedPresets', '\App\Http\Controllers\MergedController@saveUpdatedPresets');

    $api->get('getPOPs', '\App\Http\Controllers\MergedController@getPOPs');

    $api->group([ 'prefix' => 'widgetTemplate', 'namespace' => '\App\Http\Controllers\Api\WidgetTemplate'], function($api) {
      $api->post('', 'WidgetTemplateController@saveWidget');
      $api->get('list', 'WidgetTemplateController@listWidgets');
    });

    $api->group([ 'prefix' => 'routerflow', 'namespace' => '\App\Http\Controllers\Api\RouterFlow'], function($api) {
        $api->get("/list", "FlowController@listFlows");
        $api->get("/listTemplates", "FlowController@listTemplates");
        $api->get("/{flowId}", "FlowController@flowData");
        $api->post("/", "FlowController@saveFlow");
        $api->post("/{flowId}", "FlowController@updateFlow");
        $api->delete("/{flowId}", "FlowController@deleteFlow");
    });

    $api->group([ 'prefix' => 'flow', 'namespace' => '\App\Http\Controllers\Api\Flow'], function($api) {
        $api->get("/list", "FlowController@listFlows");
        $api->get("/listTemplates", "FlowController@listTemplates");
        $api->get("/{flowId}", "FlowController@flowData");
        $api->post("/", "FlowController@saveFlow");
        $api->post("/{flowId}", "FlowController@updateFlow");
        $api->put("/{flowId}", "FlowController@updateFlow");
        $api->delete("/{flowId}", "FlowController@deleteFlow");
    });

    $api->group([ 'prefix' => 'did', 'namespace' => '\App\Http\Controllers\Api\DIDNumber'], function($api) {
        $api->get("/list", "DIDNumberController@listNumbers");
        $api->get("/availableNumbers", "DIDNumberController@availableNumbers");
        $api->get("/{numberId}", "DIDNumberController@numberData");
        $api->post("/", "DIDNumberController@saveNumber");
        $api->put("/{numberId}", "DIDNumberController@updateNumber");
        $api->delete("/{numberId}", "DIDNumberController@deleteNumber");
    });

      $api->group([ 'prefix' => 'port', 'namespace' => '\App\Http\Controllers\Api\PortNumber'], function($api) {
        $api->get("/list", "PortNumberController@listNumbers");
        $api->post("/", "PortNumberController@saveNumber");
        $api->post("/{numberId}", "PortNumberController@updateNumber");
        $api->get("/{numberId}", "PortNumberController@numberData");
        $api->delete("/{numberId}", "PortNumberController@deleteNumber");
    });

    $api->group([ 'prefix' => 'extension', 'namespace' => '\App\Http\Controllers\Api\Extension'], function($api) {
        $api->get("/list", "ExtensionController@listExtensions");
        $api->get("/{extensionId}", "ExtensionController@extensionData");
        $api->get("/{extensionId}/history", "ExtensionController@extensionDataHistory");
        $api->post("/", "ExtensionController@saveExtension");
        $api->post("/{extensionId}", "ExtensionController@updateExtension");
        $api->put("/{extensionId}", "ExtensionController@updateExtension");
        $api->delete("/{extensionId}", "ExtensionController@deleteExtension");
    });

    $api->group([ 'prefix' => 'function', 'namespace' => '\App\Http\Controllers\Api\Macro'], function($api) {
        $api->get("/list", "MacroController@listFunctions");
        $api->get("/{functionId}", "MacroController@functionData");
        $api->post("/", "MacroController@saveFunction");
        $api->post("/{functionId}", "MacroController@updateFunction");
        $api->put("/{functionId}", "MacroController@updateFunction");
        $api->delete("/{functionId}", "MacroController@deleteFunction");

        $api->get("/templateData/{templateId}", "MacroController@templateData");
        $api->post("/templateData", "MacroController@saveTemplate");
        $api->post("/templateData/{templateId}", "MacroController@updateTemplate");
        $api->put("/templateData/{templateId}", "MacroController@updateTemplate");
        $api->delete("/templateData/{templateId}", "MacroController@deleteTemplate");
        $api->get("/templateData/list", "MacroController@listTemplates");

    });



    $api->group([ 'prefix' => 'byo', 'namespace' => '\App\Http\Controllers\Api\BYO'], function($api) {
      $api->group([ 'prefix' => 'carrier', 'namespace' => '\Carrier'], function($api) {
        $api->get("/list", "BYOCarrierController@listCarriers");
        $api->get("/{carrierId}", "BYOCarrierController@carrierData");
        $api->post("/", "BYOCarrierController@saveCarrier");
        $api->post("/{carrierId}", "BYOCarrierController@updateCarrier");
        $api->put("/{carrierId}", "BYOCarrierController@updateCarrier");
        $api->delete("/{carrierId}", "BYOCarrierController@deleteCarrier");
      });

      $api->group([ 'prefix' => 'did', 'namespace' => '\DID'], function($api) {
        $api->get("/list", "BYODIDNumberController@listNumbers");
        $api->post("/import", "BYODIDNumberController@importNumbers");
        $api->get("/{numberId}", "BYODIDNumberController@numberData");
        $api->post("/", "BYODIDNumberController@saveNumber");
        $api->post("/{numberId}", "BYODIDNumberController@updateNumber");
        $api->put("/{numberId}", "BYODIDNumberController@updateNumber");
        $api->delete("/{numberId}", "BYODIDNumberController@deleteNumber");
      });

    });

      $api->group([ 'prefix' => 'trunk', 'namespace' => '\App\Http\Controllers\Api\SIPTrunk'], function($api) {
          $api->get("/list", "SIPTrunkController@listTrunks");
          $api->get("/{trunkId}", "SIPTrunkController@trunkData");
          $api->post("/", "SIPTrunkController@saveTrunk");
          $api->post("/{trunkId}", "SIPTrunkController@updateTrunk");
          $api->put("/{trunkId}", "SIPTrunkController@updateTrunk");
          $api->delete("/{trunkId}", "SIPTrunkController@deleteTrunk");
      });
    $api->group([ 'prefix' => 'call', 'namespace' => '\App\Http\Controllers\Api\Call'], function($api) {
        $api->get("/list", "CallController@listCalls");
        $api->get("/{callId}", "CallController@callData");
    });
    $api->group([ 'prefix' => 'call', 'namespace' => '\App\Http\Controllers\Api\Call'], function($api) {
        $api->get("/list", "CallController@listCalls");
        $api->get("/graph", "CallController@graphData");
        $api->get("/{callId}", "CallController@callData");
        $api->post("/{callId}", "CallController@updateCall");
        $api->put("/{callId}", "CallController@updateCall");
    });
      $api->group([ 'prefix' => 'log', 'namespace' => '\App\Http\Controllers\Api\Log'], function($api) {
        $api->get("/list", "LogController@listLogs");
        $api->get("/{logId}", "LogController@logData");
    });
    $api->group([ 'prefix' => 'recording', 'namespace' => '\App\Http\Controllers\Api\Recording'], function($api) {
        $api->get("/list", "RecordingController@listRecordings");
        $api->get("/{recordingId}", "RecordingController@recordingData");
        $api->delete("/{recordingId}", "RecordingController@deleteRecording");
        $api->post("/{recordingId}/tag", "RecordingController@addRecordingTag");
        $api->delete("/{recordingId}/tag/{tagName}", "RecordingController@removeRecordingTag");
    });

    $api->group([ 'prefix' => 'phone', 'namespace' => '\App\Http\Controllers\Api\Phone'], function($api) {
        $api->get("/list", "PhoneController@listPhones");
        $api->get("/phoneDefs", "PhoneController@phoneDefs");
        $api->get("/{phoneId}", "PhoneController@phoneData");
        $api->delete("/{phoneId}", "PhoneController@deletePhone");
        $api->post("/", "PhoneController@savePhone");
        $api->post("/{phoneId}", "PhoneController@updatePhone");
        $api->put("/{phoneId}", "PhoneController@updatePhone");
    });

    $api->group([ 'prefix' => 'phoneGroup', 'namespace' => '\App\Http\Controllers\Api\PhoneGroup'], function($api) {
        $api->get("/list", "PhoneGroupController@listPhoneGroups");
        $api->get("/{phoneGroupId}", "PhoneGroupController@phoneGroupData");
        $api->delete("/{phoneGroupId}", "PhoneGroupController@deletePhoneGroup");
        $api->post("/", "PhoneGroupController@savePhoneGroup");
        $api->post("/{phoneGroupId}", "PhoneGroupController@updatePhoneGroup");
        $api->put("/{phoneGroupId}", "PhoneGroupController@updatePhoneGroup");
    });

    $api->group([ 'prefix' => 'phoneGlobalSetting', 'namespace' => '\App\Http\Controllers\Api\PhoneGlobalSetting'], function($api) {
        $api->get("/list", "PhoneGlobalSettingController@listPhoneGlobalSettings");
        $api->get("/{phoneGlobalSettingId}", "PhoneGlobalSettingController@phoneGlobalData");
        $api->delete("/{phoneGlobalSettingId}", "PhoneGlobalSettingController@deletePhoneGlobalSetting");
        $api->post("/", "PhoneGlobalSettingController@savePhoneGlobalSetting");
        $api->post("/{phoneGlobalSettingId}", "PhoneGlobalSettingController@updatePhoneGlobalSetting");
        $api->put("/{phoneGlobalSettingId}", "PhoneGlobalSettingController@updatePhoneGlobalSetting");
    });

    $api->group([ 'prefix' => 'phoneIndividualSetting', 'namespace' => '\App\Http\Controllers\Api\PhoneIndividualSetting'], function($api) {
        $api->get("/list", "PhoneIndividualSettingController@listPhoneIndividualSettings");
        $api->get("/{phoneIndividualSettingId}", "PhoneIndividualSettingController@phoneIndividualData");
        $api->delete("/{phoneIndividualSettingId}", "PhoneIndividualSettingController@deletePhoneIndividualSetting");
        $api->post("/", "PhoneIndividualSettingController@savePhoneIndividualSetting");
        $api->post("/{phoneIndividualSettingId}", "PhoneIndividualSettingController@updatePhoneIndividualSetting");
        $api->put("/{phoneIndividualSettingId}", "PhoneIndividualSettingController@updatePhoneIndividualSetting");
    });

    $api->group([ 'prefix' => 'file', 'namespace' => '\App\Http\Controllers\Api\File'], function($api) {
        $api->get("/list", "FileController@listFiles");
        $api->delete("/{fileId}", "FileController@deleteFile");
        $api->post("/upload", "FileController@upload");
        $api->post("/uploadFromGoogleDrive", "FileController@uploadByGoogleDrive");
        $api->post("/uploadFromThirdParty", "FileController@uploadFromThirdParty");
    });

      $api->group([ 'prefix' => 'fax', 'namespace' => '\App\Http\Controllers\Api\Fax'], function($api) {
        $api->get("/list", "FaxController@listFaxes");
        $api->get("/{faxId}", "FaxController@faxData");
        $api->delete("/{faxId}", "FaxController@deleteFax");
    });

    $api->group([ 'prefix' => 'credit', 'namespace' => '\App\Http\Controllers\Api\Credit'], function($api) {
        $api->post("/", "CreditController@addCredit");
        $api->post("/checkoutWithPayPal", "CreditController@checkoutWithPayPal");
        $api->get("/checkoutWithPayPalDone", "CreditController@checkoutWithPayPalDone")->name('checkout_paypal_done');
        $api->get("/checkoutWithPayPalFail", "CreditController@checkoutWithPayPalFail")->name('checkout_paypal_fail');
    });

    $api->group([ 'prefix' => 'card', 'namespace' => '\App\Http\Controllers\Api\Card'], function($api) {
        $api->get("/list", "CardController@listCards");
        $api->post("/", "CardController@addCard");
        $api->put("/{cardId}/sePprimary", "CardController@setPrimary");
        $api->delete("/{cardId}", "CardController@deleteCard");
    });

    $api->group([ 'prefix' => 'workspaceUser', 'namespace' => '\App\Http\Controllers\Api\WorkspaceUser'], function($api) {
        $api->get("/list", "WorkspaceUserController@listUsers");
        $api->post("/", "WorkspaceUserController@addUser");
        $api->delete("/{userId}", "WorkspaceUserController@deleteUser");
        $api->post("/{userId}", "WorkspaceUserController@updateUser");
        $api->put("/{userId}", "WorkspaceUserController@updateUser");
        $api->get("/{userId}", "WorkspaceUserController@userData");
        $api->post("/{userId}/resendInvite", "WorkspaceUserController@resendInvite");
    });

      $api->group([ 'prefix' => 'workspaceParam', 'namespace' => '\App\Http\Controllers\Api\WorkspaceParam'], function($api) {
        $api->get("/list", "WorkspaceParamController@listParams");
        $api->post("/saveParams", "WorkspaceParamController@saveParams");
    });

    $api->group([ 'prefix' => 'workspaceRoutingACL', 'namespace' => '\App\Http\Controllers\Api\WorkspaceRoutingACL'], function($api) {

        $api->get("/list", "WorkspaceRoutingACLController@listACLs");
        $api->post("/saveACLs", "WorkspaceRoutingACLController@saveACLs");
    });

    $api->group([ 'prefix' => 'settings', 'namespace' => '\App\Http\Controllers\Api\Settings'], function($api) {
      $api->group([ 'prefix' => 'verifiedCallerIDs'], function($api) {
        $api->get("/list", "VerifiedCallerIdsController@getVerified");
        $api->post("/", "VerifiedCallerIdsController@postVerified");
        $api->post("/confirm", "VerifiedCallerIdsController@postVerifiedConfirm");
        $api->delete("/{id}", "VerifiedCallerIdsController@deleteVerified");
      });
      $api->group([ 'prefix' => 'blockedNumbers'], function($api) {
        $api->get("/list", "BlockedNumbersController@getNumbers");
        $api->post("/", "BlockedNumbersController@postNumber");
        $api->delete("/{id}", "BlockedNumbersController@deleteNumber");
      });
      $api->group([ 'prefix' => 'ipWhitelist'], function($api) {
        $api->get("/list", "IpWhitelistController@getIpWhitelist");
        $api->post("/", "IpWhitelistController@postIpWhitelist");
        $api->delete("/{id}", "IpWhitelistController@deleteIpWhitelist");
      });

      $api->group([ 'prefix' => 'extensionCodes'], function($api) {
        $api->get("/list", "ExtensionCodeController@getExtensionCodes");
        $api->post("/", "ExtensionCodeController@postExtensionCodes");
      });
    });

    $api->group([ 'prefix' => 'cms', 'namespace' => '\App\Http\Controllers\Api\CMS'], function($api) {
        $api->group([ 'prefix' => 'faq'], function($api) {
          $api->get("/list", "FAQController@list");
        });
        $api->group([ 'prefix' => 'resource'], function($api) {
          $api->get("/list", "ResourceController@list");
          $api->get("/{key}", "ResourceController@getResource");
        });

        /*
        $api->group([ 'prefix' => 'page'], function($api) {
          $api->get("/list", "PageController@list");
          $api->get("/{key}", "PageController@getPage");
        });
        */
    });

  });
});
