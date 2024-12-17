<?php

namespace App\Livewire\Pages\Settings\Integration;

use Livewire\Component;

class IntegrationJs extends Component
{
    public string $link;

    public function copyCode()
    {
        // Emitting an event to trigger the JavaScript function
        // dd('heere');
        $this->dispatch('copyToClipboard');
    }
    public function mount()
    {
        $this->link = "<script type=\"text/javascript\" src=\"" .
            asset('storage/js/' . auth()->user()->company_id . '/swap.js') .
            "></script>";
    }
    public function render()
    {
        return view('livewire.pages.settings.integration.integration-js');
    }
}
