<?php

namespace App\Livewire\Chart;

use Livewire\Component;
use App\Models\Lead;

class Pie extends Component
{
    public $data = [];

    public function mount() {

        $this->data = Lead::selectRaw("status, COUNT(*) as count")
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.chart.pie', [
            'chartData' => json_encode(array_values($this->data)),
            'chartLabels' => json_encode(array_keys($this->data)), 
        ]);
    }
}
