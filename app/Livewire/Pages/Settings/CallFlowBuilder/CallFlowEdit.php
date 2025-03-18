<?php

namespace App\Livewire\Pages\Settings\CallFlowBuilder;

use Livewire\Component;

class CallFlowEdit extends Component
{
    public $label;
    public $recording = false;
    public function mount()
    {
        $this->label = "Greeting > Menu > Dial";
    }
    public function render()
    {
        return view('livewire.pages.settings.call-flow-builder.call-flow-edit');
    }
}
