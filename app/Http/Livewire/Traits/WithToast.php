<?php

namespace App\Http\Livewire\Traits;

trait WithToast
{
    protected function openToast(string $mode, array $options = [])
    {   
        $this->emitTo('modules.toast', 'showToast', $mode, $options);
    }

    protected function closeToast()
    {
        $this->emitTo('modules.toast', 'closeToast');
    }
    
}