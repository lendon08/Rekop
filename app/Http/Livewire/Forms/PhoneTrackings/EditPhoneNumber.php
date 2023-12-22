<?php

namespace App\Http\Livewire\Forms\PhoneTrackings;

use App\Http\Livewire\Traits\WithForm;
use App\Http\Livewire\Traits\WithToast;
use App\Integrations\SignalWire;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class EditPhoneNumber extends Component
{

    use WithForm,WithToast;

    public $data=[];
    
    public $action="";
    
    public $name;

    public $schedid = [];
    
    public $xmlbins=[];

    public $startsched = [];

    public $endsched = [];


    //initialize before opening form
    public function mount($action, $data){
        $this->action = $action;
        $this->data = $data;
        $this->name = $data['name'];
        
        foreach($data['schedule'] as $key => $sched){
            $this->startsched[$key] = $this->arrangeTime($sched['start_sched']);
            $this->endsched[$key] = $this->arrangeTime($sched['end_sched']);
            $this->xmlbins[$key] = $sched['bin_name'];
            $this->schedid[$key] = $sched['id'];
        }
       
    }
    private function arrangeTime($time){
        return date('H:i', strtotime($time));
    }

    public function create(){
        //IMPORTANT
        
        //1. Create Cron job to trigger signalwire udpate

        //2. Trigger Cron job using database time

        //3. Upddate signalwire on the cronjob trigger
        // SignalWire::updateForwarding("/api/relay/rest/phone_numbers/".$this->data['id'], id_here );

        dd($this);
        
        foreach($this->schedid as $key => $id){
            DB::table('phonenumbers')
                ->where('id', $id)
                ->update([
                    'call_request_url' => "https://".env("SIGNALWIRE_SPACE_URL")."/laml-bins/".$this->xmlbins[$key], 
                    'start_sched' => $this->startsched[$key], 
                    'end_sched' => $this->endsched[$key]
                ]);
        }
      
        
    
        session(['title' => 'Success', 'message' => 'Call Forwarding settings has been updated!']);
        
        $this->closeForm();
        
        $this->openToast('success');
    }



    public function render()
    {
        return view('livewire.forms.phone-trackings.edit-phone-number');
    }
}   
