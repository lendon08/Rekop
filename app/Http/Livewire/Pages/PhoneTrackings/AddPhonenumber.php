<?php

namespace App\Http\Livewire\Pages\PhoneTrackings;

use App\Integrations\SignalWire;
use Livewire\Component;
use App\Models\Regions;

class AddPhonenumber extends Component
{
    public $regions =[];

    public $region ="";

    public $phoneNumbers = [];

    public $sortField ="";

    public $sortDirection = 'asc';

    public function mount(){
        $this->regions  = Regions::get();
    }

    public function render()
    {
        return view('livewire.pages.phone-trackings.add-phonenumber');
    }

    public function findPhonenumber(){
        $region = Regions::where('name', $this->region)->first();
        $this->phoneNumbers =  SignalWire::http('/api/relay/rest/phone_numbers/search?region='.$region['code'])['data'];
    }


    public function buyPhonenumber($number){
        // 1. signalwire

        // 2. Save in database (will be use to display your numbers)


    }
    public function sortBy($field)
    {
        if ($field === $this->sortField) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }
}
