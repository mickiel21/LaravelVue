<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $route_name = Route::getCurrentRoute()->getName();
      
        $exceptions = [
           'register'
        ];
        
        if(in_array($route_name, $exceptions)){
            return $next($request);
        }

        if($route_name == 'login'){
            return $next($request);
        }
        if(\Auth::user()) {
            if($route_name == 'logout'){
                return $next($request);
            }
            return $next($request);
           
        }

        return notAuthorizedResponse("You are not authorized to perform this operation " , 401);
    }
}
