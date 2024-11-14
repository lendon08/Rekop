<?php

namespace App\Livewire\Pages\PhoneTrackings\Edittrackings;

use App\Models\Phonenumbers;
use Livewire\Attributes\On;
use Livewire\Component;

class Insertoptions extends Component
{

    public $insertoptions;
    public $id;
    public $phone;

    public $swaptarget;
    public $trackingsource;
    public $trackingoptions;

    #[On('toggleInsertOption')]
    public function toggle($data)
    {
        $this->insertoptions = $data;
    }
    public function closeInsert($toggle)
    {
        $this->dispatch('toggleParent', toggle: $toggle);
    }
    public function mount($data, $phone, $id)
    {
        $this->id = $id;
        $this->phone = $phone;
        $this->insertoptions = $data;
        $this->trackingoptions = $this->phone->tracking->tracking_options->value;
        $this->swaptarget = $phone->tracking->swaptarget;
    }
    public function render()
    {
        $this->phone = Phonenumbers::find($this->id);
        return view('livewire.pages.phone-trackings.edittrackings.insertoptions');
    }
}
