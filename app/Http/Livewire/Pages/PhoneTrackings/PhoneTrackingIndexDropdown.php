<?php

namespace App\Http\Livewire\Pages\PhoneTrackings;

use Livewire\Component;

class PhoneTrackingIndexDropdown extends Component
{
    public $key=[];
    public $sched=[];
    public function mount($sched){
        $this->sched = $sched;
        // dd($sched);
    }
    public function render()
    {
        return view('livewire.pages.phone-trackings.phone-tracking-index-dropdown');
    }
}
