<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EnsureBusinessHasActivePlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || !session()->has('businessId')) {
            return redirect()->route('dashboard')->with('error', 'Business context is missing.');
        }

        $business = $user->businesses()->find(session('businessId'));

        if (!$business) {
            return redirect()->route('dashboard')->with('error', 'Business not found.');
        }

        // Get the most recent subscription (latest record in pivot)
        $subscription = $business->plans()
            ->latest('business_plan.created_at')
            ->first();

        if (!$subscription) {
            return redirect()->route('subscriptions.index')
                ->with('error', 'No plan is assigned to this business.');
        }

        $pivot = $subscription->pivot;

        $now = Carbon::now();

        $isTrialValid = $pivot->is_trial && $pivot->trial_ends_at && $now->lt(Carbon::parse($pivot->trial_ends_at));
        $isPaidValid = !$pivot->is_trial && $pivot->ends_at && $now->lt(Carbon::parse($pivot->ends_at));

        if (!$isTrialValid && !$isPaidValid) {
            return redirect()->route('business.subscriptions')
                ->with('error', 'Your subscription has expired. Please renew to continue using the system.');
        }


        return $next($request);
    }
}
