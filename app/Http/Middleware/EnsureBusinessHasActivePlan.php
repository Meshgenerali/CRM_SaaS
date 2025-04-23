<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\BusinessPlan;

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

        // Ensure user is authenticated and has a business context
        if (!$user || !session()->has('businessId')) {
            return redirect()->route('dashboard')->with('error', 'No business selected or you are not logged in.');
        }

        // Get the current business from session
        $business = $user->businesses()->find(session('businessId'));

        if (!$business) {
            return redirect()->route('dashboard')->with('error', 'The selected business does not exist.');
        }

        // Fetch latest business plan (from pivot table)
        $subscription = $business->plans()
            ->latest('business_plans.created_at')
            ->first();

        if (!$subscription || !$subscription->pivot) {
            return redirect()->route('business.subscriptions')
                ->with('error', 'Trial Period Expired. Please Click Subscribe To Checkout');
        }

        $pivot = $subscription->pivot;
        $now = now();

        // Check subscription validity
        $isTrialActive = $pivot->is_trial && $pivot->trial_ends_at && $now->lt(Carbon::parse($pivot->trial_ends_at));
        $isPaidActive = !$pivot->is_trial && $pivot->ends_at && $now->lt(Carbon::parse($pivot->ends_at));

        if (!$isTrialActive && !$isPaidActive) {
            return redirect()->route('business.subscriptions')
                ->with('error', 'Your subscription has expired. Please renew to continue.');
        }

        return $next($request);
    }
}
