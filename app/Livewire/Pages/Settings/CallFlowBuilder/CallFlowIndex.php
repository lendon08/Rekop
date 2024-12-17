<?php

namespace App\Livewire\Pages\Settings\CallFlowBuilder;

use Livewire\Component;

use Livewire\Attributes\Title;

#[Title('Call Flow Builder')]
class CallFlowIndex extends Component
{
    public $label;
    public function mount()
    {
        $this->label = "Greeting > Menu > Dial";
    }
    public function render()
    {
        return view('livewire.pages.settings.call-flow-builder.call-flow-index');
    }
}
