<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CheckExpiredBusinessPlans;

class DispatchPlanCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plans:check-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatches a job to check and disable expired business plans';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        CheckExpiredBusinessPlans::dispatch();
        $this->info('Job dispatched: CheckExpiredBusinessPlans');
    }
}
