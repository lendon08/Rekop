<?php

namespace App\Http\Livewire\Forms\PhoneTrackings;

use App\Http\Livewire\Traits\WithForm;
use App\Http\Livewire\Traits\WithToast;
use App\Integrations\SignalWire;
use Livewire\Component;

class EditPhoneNumber extends Component
{

    use WithForm,WithToast;

    public $data=[];
    public $action="";
    public $name;
    public $forwarding;
    public $starttime="01:30";
    public $endtime="02:30";
    //initialize before opening form
    public function mount($action, $data){
        $this->action = $action;
        $this->data = $data;
        $this->name = $data['name'];
        $this->forwarding= substr($data['call_request_url'], 46);
    }

    public function create(){
        
        SignalWire::updateForwarding("/api/relay/rest/phone_numbers/".$this->data['id'],$this->forwarding );
    
        session(['title' => 'Success', 'message' => 'Call Forwarding settings has been updated!']);
        
        $this->closeForm();
        
        $this->openToast('success');
    }

    public function render()
    {
        return view('livewire.forms.phone-trackings.edit-phone-number');
    }
}   
