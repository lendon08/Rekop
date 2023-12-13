<?php

namespace App\Http\Livewire\Forms\PhoneTrackings;


use Livewire\Component;

class EditPhoneNumber extends Component
{

    public $data=[];
    public function mount($action, $data){
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.forms.phone-trackings.edit-phone-number');
    }
}   
