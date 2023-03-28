<?php

namespace App\Exceptions;

use Exception;
use Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        if (app()->bound('sentry') && $this->shouldReport($e)) {
            app('sentry')->captureException($e);
        }
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)
        {
            //Ajax Requests
            if($request->ajax() || $request->wantsJson())
            {
                $data = [
                    'error'   => true,
                    'message' => 'The route is not defined',
                ];
                return Response::json($data, '404');
            }
            else
            {
                //Return view 
                return response()->view('pages.notfound_404');
            }
        }
        //Handle HTTP Method Not Allowed
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException)
        {
            //Ajax Requests
            if($request->ajax() || $request->wantsJson())
            {
                $data = [
                    'error'   => true,
                    'message' => 'The http method not allowed',
                ];
                return Response::json($data, '404');
            }
            else
            {
                //Return view 
                return response()->view('pages.notfound_404');
            }
        }
        return parent::render($request, $e);
    }
}
