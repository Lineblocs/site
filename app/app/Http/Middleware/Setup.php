<?php namespace App\Http\Middleware;

use App\ApiCredential;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Routing\ResponseFactory;
use Route;

class Setup implements Middleware
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The response factory implementation.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @param  ResponseFactory  $response
     * @return void
     */
    public function __construct(Guard $auth,
        ResponseFactory $response) {
        $this->auth = $auth;
        $this->response = $response;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $creds = ApiCredential::getRecord();
        $route = Route::getCurrentRoute();
        $excluded = [
            'setup/alreadycomplete',
            'setup/restart',
        ];
        if ($creds->setup_complete && !in_array($route->getPath(), $excluded)) {
            return $this->response->redirectTo('/setup/alreadycomplete');
        }
        return $next($request);
    }

}
