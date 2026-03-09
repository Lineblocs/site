<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\ApiCredentialKVStore;
use Route;

class Setup implements Middleware {

    protected $auth;
    protected $response;

    public function __construct(Guard $auth, ResponseFactory $response)
    {
        $this->auth = $auth;
        $this->response = $response;
    }

    private function pathForStep($step)
    {
        $map = [
            1 => '/setup/storage',
            2 => '/setup/tts',
            3 => '/setup/payments',
            4 => '/setup/smtp',
            5 => '/setup/admin',
            6 => '/setup/customization',
            7 => '/setup/complete',
        ];
        if (isset($map[$step])) {
            return $map[$step];
        }
        return '/setup/storage';
    }

    public function handle($request, Closure $next)
    {
        $creds = ApiCredentialKVStore::getRecord();
        $route = Route::getCurrentRoute();
        $path = $route->getPath();

        if ($path === 'setup/restart') {
            return $next($request);
        }

        $setupComplete = !empty($creds->setup_complete);
        if ($setupComplete) {
            if ($path !== 'setup/alreadycomplete') {
                return $this->response->redirectTo('/setup/alreadycomplete');
            }
            return $next($request);
        }

        if ($path === 'setup/alreadycomplete') {
            return $this->response->redirectTo($this->pathForStep((int)$creds->setup_current_step));
        }

        if ($request->isMethod('get')) {
            $currentStep = (int)$creds->setup_current_step;
            if ($currentStep < 1) {
                $currentStep = 1;
            }
            $resumePath = $this->pathForStep($currentStep);

            if ($path === 'setup' || ('/' . $path) !== $resumePath) {
                return $this->response->redirectTo($resumePath);
            }
        }

        return $next($request);
    }
}
