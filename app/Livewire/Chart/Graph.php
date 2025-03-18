<?php

namespace App\Livewire\Chart;

use Livewire\Component;

use App\Models\Lead;
use Illuminate\Support\Facades\DB;

class Graph extends Component
{

    public $chartData = [];
    public $chartLabels = [];

    public function mount() {
        // Get lead count per day (last 30 days)
        $leads = Lead::selectRaw("DATE(created_at) as date, COUNT(*) as count")
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $this->chartLabels = $leads->pluck('date')->toArray();  
        $this->chartData = $leads->pluck('count')->toArray();
    }
    public function render()
    {
        return view('livewire.chart.graph', [
            'chartLabels' => json_encode($this->chartLabels),
            'chartData' => json_encode($this->chartData),
        ]);
    }
}
