<?php

namespace App\Livewire\Pages\PhoneTrackings;

use Livewire\Component;
use App\Models\Region;

class AddPhonenumber extends Component
{
    public $regions = [];

    public function mount()
    {
        $this->regions  = Region::get();
        // dd($this->region);
    }
    public function render()
    {
        return view('livewire.pages.phone-trackings.add-phonenumber');
    }
    public function buyPhonenumber()
    {
        dd($this);
    }
}
