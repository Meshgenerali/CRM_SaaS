<?php
namespace App\Livewire\Lead;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\LeadStatus;
use App\Models\Business;

class AddStageModal extends Component
{
    public $showModal = false;
    public $stageName = '';
    public $stageColor = '#4f46e5'; // Default to indigo color
    public $stageOrder = 0;


    protected $listeners = ['openAddStageModal' => 'openModal'];

    protected $rules = [
        'stageName' => 'required|min:2|max:30',
        'stageColor' => 'required',
        'stageOrder' => 'required|integer|min:0',
    ];

    protected $messages = [
        'stageName.required' => 'Please provide a name for this stage.',
        'stageName.min' => 'Stage name must be at least 2 characters.',
        'stageName.max' => 'Stage name cannot exceed 30 characters.',
        'stageColor.required' => 'Please select a color for this stage.',
        'stageOrder.required' => 'Stage order is required.',
        'stageOrder.integer' => 'Stage order must be a number.',
        'stageOrder.min' => 'Stage order must be at least 0.',
    ];

    public function openModal()
    {
        // Get the maximum order value and increment it
        $maxOrder = LeadStatus::max('order') ?? 0;
        $this->stageOrder = $maxOrder + 1;
        $this->showModal = true;
    }

    public function cancel()
    {
        $this->showModal = false;
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->stageName = '';
        $this->stageColor = '#4f46e5';
        $this->resetErrorBag();
    }

    public function addStage()
    {

        try {
            // Check if a stage with this name already exists
            $exists = LeadStatus::where('name', $this->stageName)->exists();
            
            if ($exists) {
                $this->addError('stageName', 'A stage with this name already exists.');
                return;
            }

            // Create new lead status (stage)
            LeadStatus::create([
                'business_id' =>session('businessId'),
                'name' => $this->stageName,
                'slug' => Str::slug($this->stageName),
                'color' => $this->stageColor,
                'order' => $this->stageOrder,
                'is_active' => true,
            ]);

            // Close modal and reset inputs
            $this->showModal = false;
            $this->resetInputs();

            // Emit event to notify the parent component to refresh stages
            $this->dispatch('refreshStages');

            // Show success notification
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => "Stage '{$this->stageName}' has been created successfully!"
            ]);
        } catch (\Exception $e) {
            // Show error notification
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => "Failed to create stage: {$e->getMessage()}"
            ]);
        }
    }

    public function render()
    {
        return view('livewire.lead.add-stage-modal');
    }
}