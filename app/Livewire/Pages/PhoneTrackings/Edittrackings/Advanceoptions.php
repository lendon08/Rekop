<?php

namespace App\Livewire\Pages\PhoneTrackings\Edittrackings;

use App\Models\Phonenumbers;
use Livewire\Attributes\On;
use Livewire\Component;

class Advanceoptions extends Component
{
    public $id;
    public $phone;
    public $advanceoptions;
    public $textmsg;
    public $analytics = "auto";
    public $utm_source;
    public $utm_medium;
    public $utm_campaign;
    public $callerid;

    #[On('toggleAdvanceOption')]
    public function toggle($data)
    {
        $this->advanceoptions = $data;
    }

    public function save()
    {
        // update database
        dd($this->textmsg);
    }
    public function closeAdvance($toggle)
    {
        $this->dispatch('toggleParent', toggle: $toggle);
    }
    public function mount($data, $phone, $id)
    {
        $this->id = $id;
        $this->phone = $phone;
        $this->advanceoptions = $data;

        //todo
        $this->textmsg = true;
        $this->callerid = 'tracking';
        if ($this->analytics == "auto") {
            $this->initialize(1);
        }
    }
    public function initialize($flag)
    {
        if ($flag) {
            $this->utm_source = $this->phone->name;
            $this->utm_medium = $this->phone->number;
            $this->utm_campaign = $this->phone->tracking->poolname;
        } else {
            $this->utm_source = "";
            $this->utm_medium = "";
            $this->utm_campaign = "";
        }
    }
    public function updatedAnalytics($value)
    {
        if ($this->analytics == "auto") {
            $this->initialize(1);
        }
        if ($this->analytics == "no") {
            $this->initialize(0);
        }
    }
    public function render()
    {
        if ($this->analytics == "auto") {
            $this->initialize(1);
        }
        $this->phone = Phonenumbers::find($this->id);
        return view('livewire.pages.phone-trackings.edittrackings.advanceoptions');
    }
}
