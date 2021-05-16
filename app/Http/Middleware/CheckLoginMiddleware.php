<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $route)
    {
        $check = session()->has('user_id');
        if ($check === false && $route == 'api') {
            $response = ResponseHelper::responseMaker(503, null, null);
            throw new HttpResponseException(response()->json($response, 400)->header('Content-Type', 'application/json'));
            //return redirect('/');
        }

        if ($route == 'web' && $check === false) {
            return  redirect('/');
        }

        if ($route == 'login' && $check === true) {
            return  redirect('/forum');
        }

        return $next($request);
    }
}
