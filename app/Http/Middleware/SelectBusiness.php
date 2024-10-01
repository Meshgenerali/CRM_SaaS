<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SelectBusiness
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $businessCount = Auth::user()->businesses->count();
        if($businessCount == 1) {
            // start session
        } elseif($businessCount == 0) {
            return redirect('/?register=true');
        }

        return $next($request);
        
    }
}
