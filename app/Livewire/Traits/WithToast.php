<?php

namespace App\Livewire\Traits;

trait WithToast
{
    protected function openToast(string $mode, array $options = [])
    {   
        $this->dispatch('showToast', $mode, $options)->to('modules.toast');
    }

    protected function closeToast()
    {
        $this->dispatch('closeToast')->to('modules.toast');
    }
    
}