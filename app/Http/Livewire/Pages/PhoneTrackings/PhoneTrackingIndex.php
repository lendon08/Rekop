<?php

namespace App\Http\Livewire\Pages\PhoneTrackings;

use App\Http\Livewire\Traits\WithForm;
use App\Integrations\SignalWire;
use Livewire\Component;

class PhoneTrackingIndex extends Component
{
    use WithForm;


    protected $listeners = [
        'phoneTrackingIndexRefresh' => '$refresh',
    ];

    public function render()
    {
        $phoneNumbers = SignalWire::http('/api/relay/rest/phone_numbers');
        // dd($phoneNumbers);
        return view('livewire.pages.phone-trackings.phone-tracking-index', compact('phoneNumbers'));
    }

    public function createPhoneNum()
    {
        $this->openForm('forms.phone-trackings.add-phone-number');
    }

    public function viewPhoneNum()
    {
        $this->openForm('forms.phone-trackings.view-phone-number');
    }

}
