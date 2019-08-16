<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsBlogger
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
        $user = Auth::user();
        if($user->isBlogger == 1){
            return $next($request);
        }
        else{
            return response()->json(['Para realizar esta ação é necessário ser um blogger.']);
        }
    }
}
