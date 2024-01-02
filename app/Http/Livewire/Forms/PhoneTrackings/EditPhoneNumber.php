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

    public $fwd = [];

    public function mount($action, $data){
        $this->action = $action;
        $this->data = $data;
        $this->name = $data['name'];
        // dd($data);
        foreach($data['schedule'] as $key => $sched){
            // dd($sched['fwd']);
            $this->startsched[$key] = $this->arrangeTime($sched['start_sched']);
            $this->endsched[$key] = $this->arrangeTime($sched['end_sched']);
            $this->xmlbins[$key] = $sched['bin_name'];
            $this->schedid[$key] = $sched['id'];
            $this->fwd[$key] = $sched['fwd'];
        }
       
    }
    private function arrangeTime($time){
        return date('H:i', strtotime($time));
    }

    public function create(){
       
        foreach($this->schedid as $key => $id){
            DB::table('phonenumbers')
                ->where('id', $id)
                ->update([
                    'start_sched' => $this->startsched[$key], 
                    'end_sched' => $this->endsched[$key],
                    'fwd' => $this->fwd[$key]
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
