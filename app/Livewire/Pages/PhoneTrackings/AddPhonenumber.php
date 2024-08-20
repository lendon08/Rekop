<?php

namespace App\Livewire\Pages\PhoneTrackings;

use Livewire\Component;
use App\Models\Regions;

class AddPhonenumber extends Component
{
    public $regions =[];

    public function mount(){
        $this->regions  = Regions::get();
        // dd($this->regions);
    }
    public function render()
    {
        return view('livewire.pages.phone-trackings.add-phonenumber');
    }
    public function buyPhonenumber(){
        dd($this);
    }
}
