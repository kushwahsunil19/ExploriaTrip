<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $route =$request->route()->getName();
        if($request->url() != "https://exploriatrip.com"){
            return redirect("https://exploriatrip.com/$route");
        }
        else{
            return $next($request);
        }

        
        // elseif($request->url() != "https://exploriatrip-live.webiators.com"){
        //     return redirect("https://exploriatrip-live.webiators.com/$route");
        // }

        // else{
        //     return $next($request);
        // }
    }
}
