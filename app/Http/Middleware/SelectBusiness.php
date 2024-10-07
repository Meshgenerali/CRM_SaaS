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
        if($request->session()->get('businessId')) {
            //dd('sss started');

        } else {

            $businessCount = Auth::user()->businesses->count();
            if($businessCount == 1) {
                // start session
                $request->session()->put('businessId', Auth::user()->businesses[0]->id);
                return redirect('dashboard');
            } elseif($businessCount == 0) {
                return redirect('/?register=true');
            } elseif ($businessCount>1) {
                return redirect('/?selectBusiness=true');
            }
        }
        return $next($request);
        
    }
}
