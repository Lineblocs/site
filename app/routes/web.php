<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
/****************   Model binding into route **************************/
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[0-9a-z-_]+');
/***************    Site routes  **********************************/

Route::get('/', 'HomeController@index');
Route::get('healthz', 'HealthzController@healthz');
Route::group(['prefix' => 'setup', 'middleware' => '\App\Http\Middleware\Setup'], function () {
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
    route::get('customization', 'setupcontroller@setup_customization');
    route::post('customization', 'setupcontroller@save_customization');
    Route::get('complete', 'SetupController@setup_complete');
    Route::get('alreadycomplete', 'SetupController@setup_alreadycomplete');
});

Route::get('404', 'HomeController@notfound_404')->name('404');
Route::get('home', 'HomeController@index');
Route::get('about', 'HomeController@about');
Route::get('contact', 'HomeController@contact');
Route::post('contactSubmit', 'HomeController@contactSubmit');
Route::get('login', 'HomeController@login');
Route::get('pricing', 'HomeController@pricing');
Route::get('rates', 'HomeController@rates1');
Route::get('rates/{countryId}', 'HomeController@rates');
Route::get('faqs', 'HomeController@faqs');
Route::get('/pages/privacy-policy', 'PagesController@privacyPolicy');
Route::get('/pages/tos', 'PagesController@termsOfService');
Route::get('/resources', 'ResourcesController@index');
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

// Route::controllers([
//     'auth' => 'Auth\AuthController',
//     'password' => 'Auth\PasswordController',
// ]);
/***************    Admin routes  **********************************/
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    # Admin Dashboard
    Route::get('dashboard', 'Admin\DashboardController@index');

    # Users
    Route::get('user/data', 'Admin\UserController@data');
    Route::get('user/{workspaceflow}/flow', 'Admin\UserController@edit_flow');
    Route::get('user/createFlowForCountry', 'Admin\UserController@create_flow_for_country');
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
$api->version('v1', function ($api) {
    $api->group(['prefix' => 'public', 'namespace' => '\App\Http\Controllers\Api\PublicAPI'], function ($api) {
        /** /list route should be before /{id} route to avoid conflicts.. **/
        $api->group(['prefix' => 'did', 'namespace' => '\DIDNumber'], function ($api) {
            $api->get("/list", "DIDNumberController@list");
            $api->get("/{didId}", "DIDNumberController@get");
            $api->post("/", "DIDNumberController@post");
            $api->post("/{didId}", "DIDNumberController@put");
            $api->delete("/{didId}", "DIDNumberController@delete");
        });
        $api->group(['prefix' => 'extension', 'namespace' => '\Extension'], function ($api) {
            $api->get("/list", "ExtensionController@list");
            $api->get("/{extensionId}", "ExtensionController@get");
            $api->post("/", "ExtensionController@post");
            $api->post("/{extensionId}", "ExtensionController@put");
            $api->delete("/{extensionId}", "ExtensionController@delete");
        });
        $api->group(['prefix' => 'user', 'namespace' => '\User'], function ($api) {
            $api->get("/list", "UserController@list");
            $api->get("/{userId}", "UserController@get");
            $api->post("/", "UserController@post");
            $api->post("/{userId}", "UserController@put");
            $api->delete("/{userId}", "UserController@delete");
        });
        $api->group(['prefix' => 'blocked', 'namespace' => '\BlockedNumber'], function ($api) {
            $api->get("/list", "BlockedNumberController@list");
            $api->get("/{blockedId}", "BlockedNumberController@get");
            $api->post("/", "BlockedNumberController@post");
            $api->post("/{blockedId}", "BlockedNumberController@put");
            $api->delete("/{blockedId}", "BlockedNumberController@delete");
        });
        $api->group(['prefix' => 'recording', 'namespace' => '\Recording'], function ($api) {
            $api->get("/list", "RecordingController@list");
            $api->get("/{recordingId}", "RecordingController@get");
            $api->post("/", "RecordingController@post");
            $api->post("/{recordingId}", "RecordingController@put");
            $api->delete("/{recordingId}", "RecordingController@delete");
        });
        $api->group(['prefix' => 'call', 'namespace' => '\Call'], function ($api) {
            $api->get("/list", "CallController@list");
            $api->get("/{callId}", "CallController@get");
            $api->post("/", "CallController@post");
            $api->post("/{callId}", "CallController@put");
            $api->delete("/{callId}", "CallController@delete");
        });
        $api->group(['prefix' => 'byo', 'namespace' => '\BYO'], function ($api) {
            $api->group(['prefix' => 'did', 'namespace' => '\DIDNumber'], function ($api) {
                $api->get("/list", "DIDNumberController@list");
                $api->get("/{didId}", "DIDNumberController@get");
                $api->post("/", "DIDNumberController@post");
                $api->put("/{didId}", "DIDNumberController@put");
                $api->delete("/{didId}", "DIDNumberController@delete");
            });
        });
        $api->group(['prefix' => 'trunk', 'namespace' => '\SIPTrunk'], function ($api) {
            $api->get("/list", "SIPTrunkController@list");
            $api->get("/{trunkId}", "SIPTrunkController@get");
            $api->post("/", "SIPTrunkController@post");
            $api->post("/{trunkId}", "SIPTrunkController@put");
            $api->delete("/{trunkId}", "SIPTrunkController@delete");
        });
    });
    $api->group(['prefix' => 'internal', 'namespace' => '\App\Http\Controllers\Api\Internal'], function ($api) {
        $api->group(['prefix' => 'call', 'namespace' => '\Call'], function ($api) {
            $api->post("/createCall", "CallController@createCall");
            $api->post("/updateCall", "CallController@updateCall");
        });
        $api->group(['prefix' => 'conference', 'namespace' => '\Conference'], function ($api) {
            $api->post("/createConference", "ConferenceController@createConference");
        });

        $api->group(['prefix' => 'debugger', 'namespace' => '\Debugger'], function ($api) {
            $api->post("/createLog", "LogController@createLog");
            $api->post("/createLogSimple", "LogController@createLogSimple");
        });
        $api->group(['prefix' => 'recording', 'namespace' => '\Recording'], function ($api) {
            $api->post("/createRecording", "RecordingController@createRecording");
            $api->post("/updateRecording", "RecordingController@updateRecording");
        });
        $api->group(['prefix' => 'fax', 'namespace' => '\Fax'], function ($api) {
            $api->post("/createFax", "FaxController@createFax");
        });
        $api->group(['prefix' => 'user', 'namespace' => '\User'], function ($api) {
            $api->get("/verifyCaller", "UserController@verifyCaller");
            $api->get("/verifyCallerByDomain", "UserController@verifyCallerByDomain");
            $api->get("/getUserByDomain", "UserController@getUserByDomain");
            $api->get("/getWorkspaceMacros", "UserController@getWorkspaceMacros");
            $api->get("/getDIDNumberData", "UserController@getDIDNumberData");
            $api->get("/getPSTNProvierIP", "UserController@getPSTNProviderIP");

            $api->get("/ipWhitelistLookup", "UserController@ipWhitelistLookup");
            $api->get("/getDIDAcceptOption", "UserController@getDIDAcceptOption");
            $api->get("/getDIDAssignedIP", "UserController@getDIDAssignedIP");
            $api->get("/getUserAssignedIP", "UserController@getUserAssignedIP");
            $api->get("/getPSTNProviderIP", "UserController@getPSTNProviderIP");
            $api->get("/addPSTNProviderTechPrefix", "UserController@addPSTNProviderTechPrefix");
            $api->get("/getCallerIdToUse", "UserController@getCallerIdToUse");
            $api->get("/getExtensionFlowInfo", "UserController@getExtensionFlowInfo");
            $api->get("/getDIDDomain", "UserController@getDIDDomain");
            $api->get("/getCodeFlowInfo", "UserController@getCodeFlowInfo");
            $api->get("/incomingPSTNValidation", "UserController@incomingPSTNValidation");
            $api->get("/incomingMediaServerValidation", "UserController@incomingMediaServerValidation");
        });
        $api->group(['prefix' => 'debit', 'namespace' => '\Debit'], function ($api) {
            $api->post("/createDebit", "DebitController@createDebit");
            $api->post("/createAPIUsageDebit", "DebitController@createAPIUsageDebit");
        });
    });

    $api->get('admin/getWorkspaces', '\App\Http\Controllers\Api\AdminController@getWorkspaces');
    $api->post('internalAppRedirect', '\App\Http\Controllers\MergedController@internalAppRedirect');
    $api->get('getAllSettings', '\App\Http\Controllers\MergedController@getAllSettings');
    $api->post('jwt/authenticate', '\App\Http\Controllers\JWT\AuthenticateController@authenticate');
    $api->post('jwt/authenticatePublic', '\App\Http\Controllers\JWT\AuthenticateController@authenticatePublic');
    $api->get('jwt/heartbeat', '\App\Http\Controllers\JWT\AuthenticateController@heartbeat');
    $api->post('forgot', '\App\Http\Controllers\RegisterController@forgot');
    $api->post('reset', '\App\Http\Controllers\RegisterController@reset');
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
    $api->post('updateWorkspace', '\App\Http\Controllers\RegisterController@updateWorkspace');
    $api->post('updateWorkspace2', '\App\Http\Controllers\MergedController@updateWorkspace2');
    $api->get('fetchWorkspaceInfo', '\App\Http\Controllers\MergedController@fetchWorkspaceInfo');
    $api->get('getBillingInfo', '\App\Http\Controllers\BillingController@getBillingInfo');
    $api->get('getBillingHistory', '\App\Http\Controllers\BillingController@getBillingHistory');
    $api->get('downloadBillingHistory', '\App\Http\Controllers\BillingController@downloadBillingHistory');
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

    $api->group(['prefix' => 'widgetTemplate', 'namespace' => '\App\Http\Controllers\Api\WidgetTemplate'], function ($api) {
        $api->post('saveWidget', 'WidgetTemplateController@saveWidget');
        $api->get('listWidgets', 'WidgetTemplateController@listWidgets');
    });

    $api->group(['prefix' => 'routerflow', 'namespace' => '\App\Http\Controllers\Api\RouterFlow'], function ($api) {
        $api->get("/flowData/{flowId}", "FlowController@flowData");
        $api->post("/saveFlow", "FlowController@saveFlow");
        $api->post("/updateFlow/{flowId}", "FlowController@updateFlow");
        $api->get("/listFlows", "FlowController@listFlows");
        $api->delete("/deleteFlow/{flowId}", "FlowController@deleteFlow");
        $api->get("/listTemplates", "FlowController@listTemplates");
    });

    $api->group(['prefix' => 'flow', 'namespace' => '\App\Http\Controllers\Api\Flow'], function ($api) {
        $api->get("/flowData/{flowId}", "FlowController@flowData");
        $api->post("/saveFlow", "FlowController@saveFlow");
        $api->post("/updateFlow/{flowId}", "FlowController@updateFlow");
        $api->get("/listFlows", "FlowController@listFlows");
        $api->delete("/deleteFlow/{flowId}", "FlowController@deleteFlow");
        $api->get("/listTemplates", "FlowController@listTemplates");
    });
    $api->group(['prefix' => 'did', 'namespace' => '\App\Http\Controllers\Api\DIDNumber'], function ($api) {
        $api->get("/available", "DIDNumberController@availableNumbers");
        $api->get("/numberData/{flowId}", "DIDNumberController@numberData");
        $api->post("/saveNumber", "DIDNumberController@saveNumber");
        $api->post("/updateNumber/{numberId}", "DIDNumberController@updateNumber");
        $api->get("/listNumbers", "DIDNumberController@listNumbers");
        $api->delete("/deleteNumber/{numberId}", "DIDNumberController@deleteNumber");
    });
    $api->group(['prefix' => 'port', 'namespace' => '\App\Http\Controllers\Api\PortNumber'], function ($api) {
        $api->post("/saveNumber", "PortNumberController@saveNumber");
        $api->post("/updateNumber/{numberId}", "PortNumberController@updateNumber");
        $api->get("/numberData/{numberId}", "PortNumberController@numberData");
        $api->get("/listNumbers", "PortNumberController@listNumbers");
        $api->delete("/deleteNumber/{numberId}", "PortNumberController@deleteNumber");
    });
    $api->group(['prefix' => 'extension', 'namespace' => '\App\Http\Controllers\Api\Extension'], function ($api) {
        $api->get("/extensionData/{extensionId}", "ExtensionController@extensionData");
        $api->post("/saveExtension", "ExtensionController@saveExtension");
        $api->post("/updateExtension/{flowId}", "ExtensionController@updateExtension");
        $api->delete("/deleteExtension/{extensionId}", "ExtensionController@deleteExtension");
        $api->get("/listExtensions", "ExtensionController@listExtensions");
    });
    $api->group(['prefix' => 'function', 'namespace' => '\App\Http\Controllers\Api\Macro'], function ($api) {
        $api->get("/functionData/{functionId}", "MacroController@functionData");
        $api->post("/saveFunction", "MacroController@saveFunction");
        $api->post("/updateFunction/{functionId}", "MacroController@updateFunction");
        $api->delete("/deleteFunction/{functionId}", "MacroController@deleteFunction");
        $api->get("/listFunctions", "MacroController@listFunctions");

        $api->get("/templateData/{templateId}", "MacroController@templateData");
        $api->post("/saveTemplate", "MacroController@saveTemplate");
        $api->post("/updateTemplate/{templateId}", "MacroController@updateTemplate");
        $api->delete("/deleteTemplate/{templateId}", "MacroController@deleteTemplate");
        $api->get("/listTemplates", "MacroController@listTemplates");

    });

    $api->group(['prefix' => 'byo', 'namespace' => '\App\Http\Controllers\Api\BYO'], function ($api) {
        $api->group(['prefix' => 'carrier', 'namespace' => '\Carrier'], function ($api) {
            $api->get("/carrierData/{carrierId}", "BYOCarrierController@carrierData");
            $api->post("/saveCarrier", "BYOCarrierController@saveCarrier");
            $api->post("/updateCarrier/{carrierId}", "BYOCarrierController@updateCarrier");
            $api->delete("/deleteCarrier/{carrierId}", "BYOCarrierController@deleteCarrier");
            $api->get("/listCarriers", "BYOCarrierController@listCarriers");
        });
        $api->group(['prefix' => 'did', 'namespace' => '\DID'], function ($api) {
            $api->get("/numberData/{numbrId}", "BYODIDNumberController@numberData");
            $api->post("/saveNumber", "BYODIDNumberController@saveNumber");
            $api->post("/updateNumber/{numberId}", "BYODIDNumberController@updateNumber");
            $api->delete("/deleteNumber/{numberId}", "BYODIDNumberController@deleteNumber");
            $api->get("/listNumbers", "BYODIDNumberController@listNumbers");
            $api->post("/importNumbers", "BYODIDNumberController@importNumbers");
        });

    });
    $api->group(['prefix' => 'trunk', 'namespace' => '\App\Http\Controllers\Api\SIPTrunk'], function ($api) {
        $api->get("/list", "SIPTrunkController@listTrunks");
        $api->get("/{trunkId}", "SIPTrunkController@trunkData");
        $api->post("/", "SIPTrunkController@saveTrunk");
        $api->post("/{trunkId}", "SIPTrunkController@updateTrunk");
        $api->delete("/{trunkId}", "SIPTrunkController@deleteTrunk");
    });
    $api->group(['prefix' => 'call', 'namespace' => '\App\Http\Controllers\Api\Call'], function ($api) {
        $api->get("/callData/{callId}", "CallController@callData");
        $api->get("/listCall", "CallController@listCalls");
    });
    $api->group(['prefix' => 'call', 'namespace' => '\App\Http\Controllers\Api\Call'], function ($api) {
        $api->get("/callData/{callId}", "CallController@callData");
        $api->post("/updateCall/{callId}", "CallController@updateCall");
        $api->get("/listCalls", "CallController@listCalls");
        $api->get("/graphData", "CallController@graphData");
    });
    $api->group(['prefix' => 'log', 'namespace' => '\App\Http\Controllers\Api\Log'], function ($api) {
        $api->get("/logData/{logId}", "LogController@logData");
        $api->get("/listLogs", "LogController@listLogs");
    });
    $api->group(['prefix' => 'recording', 'namespace' => '\App\Http\Controllers\Api\Recording'], function ($api) {
        $api->get("/recordingData/{recordingId}", "RecordingController@recordingData");
        $api->delete("/deleteRecording/{recordingId}", "RecordingController@deleteRecording");
        $api->get("/listRecordings", "RecordingController@listRecordings");
        $api->post("/addRecordingTag/{recordingId}", "RecordingController@addRecordingTag");
        $api->delete("/removeRecordingTag/{recordingId}/{tagName}", "RecordingController@removeRecordingTag");
    });

    $api->group(['prefix' => 'phone', 'namespace' => '\App\Http\Controllers\Api\Phone'], function ($api) {
        $api->get("/phoneData/{phoneId}", "PhoneController@phoneData");
        $api->delete("/deletePhone/{phoneId}", "PhoneController@deletePhone");
        $api->post("/savePhone", "PhoneController@savePhone");
        $api->post("/updatePhone/{phoneId}", "PhoneController@updatePhone");
        $api->get("/listPhones", "PhoneController@listPhones");
        $api->get("/phoneDefs", "PhoneController@phoneDefs");
    });
    $api->group(['prefix' => 'phoneGroup', 'namespace' => '\App\Http\Controllers\Api\PhoneGroup'], function ($api) {
        $api->get("/phoneGroupData/{phoneGroupId}", "PhoneGroupController@phoneGroupData");
        $api->delete("/deletePhoneGroup/{phoneGroupId}", "PhoneGroupController@deletePhoneGroup");
        $api->post("/savePhoneGroup", "PhoneGroupController@savePhoneGroup");
        $api->post("/updatePhoneGroup/{phoneGroupId}", "PhoneGroupController@updatePhoneGroup");
        $api->get("/listPhoneGroups", "PhoneGroupController@listPhoneGroups");
    });
    $api->group(['prefix' => 'phoneGlobalSetting', 'namespace' => '\App\Http\Controllers\Api\PhoneGlobalSetting'], function ($api) {
        $api->get("/phoneGlobalSettingData/{phoneGlobalSettingId}", "PhoneGlobalSettingController@phoneGlobalData");
        $api->delete("/deletePhoneGlobalSetting/{phoneGlobalSettingId}", "PhoneGlobalSettingController@deletePhoneGlobalSetting");
        $api->post("/savePhoneGlobalSetting", "PhoneGlobalSettingController@savePhoneGlobalSetting");
        $api->post("/updatePhoneGlobalSetting/{phoneGlobalSettingId}", "PhoneGlobalSettingController@updatePhoneGlobalSetting");
        $api->get("/listPhoneGlobalSettings", "PhoneGlobalSettingController@listPhoneGlobalSettings");
    });
    $api->group(['prefix' => 'phoneIndividualSetting', 'namespace' => '\App\Http\Controllers\Api\PhoneIndividualSetting'], function ($api) {
        $api->get("/phoneIndividualSettingData/{phoneIndividualSettingId}", "PhoneIndividualSettingController@phoneIndividualData");
        $api->delete("/deletePhoneIndividualSetting/{phoneIndividualSettingId}", "PhoneIndividualSettingController@deletePhoneIndividualSetting");
        $api->post("/savePhoneIndividualSetting", "PhoneIndividualSettingController@savePhoneIndividualSetting");
        $api->post("/updatePhoneIndividualSetting/{phoneIndividualSettingId}", "PhoneIndividualSettingController@updatePhoneIndividualSetting");
        $api->get("/listPhoneIndividualSettings", "PhoneIndividualSettingController@listPhoneIndividualSettings");
    });
    $api->group(['prefix' => 'file', 'namespace' => '\App\Http\Controllers\Api\File'], function ($api) {
        $api->delete("/deleteFile/{fileId}", "FileController@deleteFile");
        $api->get("/listFiles", "FileController@listFiles");
        $api->post("/upload", "FileController@upload");
        $api->post("/uploadByGoogleDrive", "FileController@uploadByGoogleDrive");
    });
    $api->group(['prefix' => 'fax', 'namespace' => '\App\Http\Controllers\Api\Fax'], function ($api) {
        $api->get("/faxData/{faxId}", "FaxController@faxData");
        $api->delete("/deleteFax/{faxId}", "FaxController@deleteFax");
        $api->get("/listFaxes", "FaxController@listFaxes");
    });
    $api->group(['prefix' => 'credit', 'namespace' => '\App\Http\Controllers\Api\Credit'], function ($api) {
        $api->post("/addCredit", "CreditController@addCredit");
        $api->post("/checkoutWithPayPal", "CreditController@checkoutWithPayPal");
        $api->get("/checkoutWithPayPalDone", "CreditController@checkoutWithPayPalDone")->name('checkout_paypal_done');
        $api->get("/checkoutWithPayPalFail", "CreditController@checkoutWithPayPalFail")->name('checkout_paypal_fail');
    });
    $api->group(['prefix' => 'card', 'namespace' => '\App\Http\Controllers\Api\Card'], function ($api) {

        $api->get("/listCards", "CardController@listCards");
        $api->post("/addCard", "CardController@addCard");
        $api->put("/setPrimary/{cardId}", "CardController@setPrimary");
        $api->delete("/deleteCard/{cardId}", "CardController@deleteCard");
    });
    $api->group(['prefix' => 'workspaceUser', 'namespace' => '\App\Http\Controllers\Api\WorkspaceUser'], function ($api) {

        $api->get("/listUsers", "WorkspaceUserController@listUsers");
        $api->post("/addUser", "WorkspaceUserController@addUser");
        $api->delete("/deleteUser/{userId}", "WorkspaceUserController@deleteUser");
        $api->post("/updateUser/{userId}", "WorkspaceUserController@updateUser");
        $api->get("/userData/{userId}", "WorkspaceUserController@userData");
        $api->post("/resendInvite/{userId}", "WorkspaceUserController@resendInvite");
    });
    $api->group(['prefix' => 'workspaceParam', 'namespace' => '\App\Http\Controllers\Api\WorkspaceParam'], function ($api) {

        $api->get("/listParams", "WorkspaceParamController@listParams");
        $api->post("/saveParams", "WorkspaceParamController@saveParams");
    });

    $api->group(['prefix' => 'settings', 'namespace' => '\App\Http\Controllers\Api\Settings'], function ($api) {
        $api->get("/verifiedCallerids", "VerifiedCallerIdsController@getVerified");
        $api->post("/verifiedCallerids", "VerifiedCallerIdsController@postVerified");
        $api->post("/verifiedCallerids/confirm", "VerifiedCallerIdsController@postVerifiedConfirm");
        $api->delete("/verifiedCallerids/{id}", "VerifiedCallerIdsController@deleteVerified");
        $api->get("/blockedNumbers", "BlockedNumbersController@getNumbers");
        $api->post("/blockedNumbers", "BlockedNumbersController@postNumber");
        $api->delete("/blockedNumbers/{id}", "BlockedNumbersController@deleteNumber");
        $api->get("/ipWhitelist", "IpWhitelistController@getIpWhitelist");
        $api->post("/ipWhitelist", "IpWhitelistController@postIpWhitelist");
        $api->delete("/ipWhitelist/{id}", "IpWhitelistController@deleteIpWhitelist");

        $api->get("/extensionCodes", "ExtensionCodeController@getExtensionCodes");
        $api->post("/extensionCodes", "ExtensionCodeController@postExtensionCodes");
    });
});
