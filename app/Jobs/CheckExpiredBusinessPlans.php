<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\BusinessPlan;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class CheckExpiredBusinessPlans implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        BusinessPlan::where('is_active', true)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('is_trial', true)
                    ->where('trial_ends_at', '<=', now());
                })->orWhere(function ($q) {
                    $q->where('is_trial', false)
                    ->where('ends_at', '<=', now());
                });
            })
            ->each(function ($plan) {
                $plan->update(['is_active' => false]);
            });

        logger('✅ Business plan check completed.');
    }
}
