<?php

namespace App\Http\Livewire\Pages\PhoneTrackings;

use App\Http\Livewire\Traits\WithForm;
use App\Http\Livewire\Traits\WithToast;
use App\Integrations\SignalWire;
use Livewire\Component;

class PhoneTrackingIndex extends Component
{
    use WithForm,WithToast;

    public $flashmessage="";
    public $xmlBins = [];
    public $phoneNumbers = [];
    protected $listeners = [
        'phoneTrackingIndexRefresh' => '$refresh',
    ];

    public function mount()
    {
        $this->xmlBins = SignalWire::http("/api/laml/2010-04-01/Accounts/".env("SIGNALWIRE_PROJECTID")."/LamlBins");
        $this->phoneNumbers = SignalWire::http('/api/relay/rest/phone_numbers');
        foreach($this->phoneNumbers['data'] as $key =>$pn){
            $this->phoneNumbers['data'][$key]['number'] = $this->beautifyPhoneNumber($pn['number']);
            $this->phoneNumbers['data'][$key]['bin_name'] = $this->checkBinName($pn['call_request_url'], $this->xmlBins['laml_bins']);
        }   
    }
    public function render()
    {
        return view('livewire.pages.phone-trackings.phone-tracking-index');
    }
    
    private function checkBinName($id, $bins){
        foreach($bins as $bin){
            if($bin['request_url'] == $id) return $bin['name'];
        }
    }
    private function beautifyPhoneNumber($number){
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
