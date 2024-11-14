<?php

namespace App\Livewire\Pages\PhoneTrackings\Edittrackings;

use App\Models\Phonenumbers;
use Livewire\Attributes\On;
use Livewire\Component;

class Numberoptions extends Component
{
    public $numberOptions = true;

    public $id = "";

    public $phone;

    public $callgreeting = false;
    public $name;
    public $number;
    public $whisper;

    #[On('toggleNumberOption')]
    public function toggle($data)
    {
        $this->numberOptions = $data;
    }

    public function closeNumber($toggle)
    {
        $this->dispatch('toggleParent', toggle: $toggle);
    }

    public function mount($data, $phone, $id)
    {
        $this->id = $id;
        $this->phone = $phone;
        $this->numberOptions = $data;
        $this->name = $this->phone->name;
        $this->number = $this->phone->tracking->callforwarding;
        $this->whisper = false;
    }
    public function render()
    {
        $this->phone = Phonenumbers::find($this->id);
        return view('livewire.pages.phone-trackings.edittrackings.numberoptions');
    }
}
