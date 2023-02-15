<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    // protected $auth;

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
    // public function __construct($auth,
    //     ResponseFactory $response) {
    //     $this->auth = $auth;
    //     $this->response = $response;
    // }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $admin = 0;
                if (Auth::user()->admin == 1) {
                    $admin = 1;
                }
                if ($admin == 0) {
                    return $this->response->redirectTo('/');
                }
                return $next($request);
            }

        }
        return $next($request);
        //return $this->response->redirectTo('/');
    }

}
