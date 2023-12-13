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
        
        foreach($phoneNumbers['data'] as $key =>$pn){
            $phoneNumbers['data'][$key]['number'] = $this->beautifyPhoneNumber($pn['number']);
        }        
        return view('livewire.pages.phone-trackings.phone-tracking-index', compact('phoneNumbers'));
    }

    public function beautifyPhoneNumber($number){
        return substr($number, 2,3).'-'.substr($number, 5,3).'-'.substr($number, 8,4);
    }

    public function createPhoneNum()
    {
        $this->openForm('forms.phone-trackings.add-phone-number');
    }

    public function viewPhoneNum()
    {
        $this->openForm('forms.phone-trackings.view-phone-number');
    }
    public function editPhoneNum($id){
        $phoneInfo = SignalWire::http("/api/relay/rest/phone_numbers/".$id);
        $xmlBins = SignalWire::http("/api/laml/2010-04-01/Accounts/".env("SIGNALWIRE_PROJECTID")."/LamlBins");
        $phoneInfo['bins']=$xmlBins['laml_bins']; 
        
        $this->openForm('forms.phone-trackings.edit-phone-number', 'create' , $phoneInfo);
    }

}
