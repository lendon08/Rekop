<?php

namespace App\Livewire\Pages\PhoneTrackings\Edittrackings;

use App\Http\Controllers\FileController;
use App\Models\Phonenumbers;
use App\Models\Phonetracking;
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
        // dd($this->utm_source);
        Phonetracking::where('phonenumber_id', $this->id)->update([
            'textmsg' => $this->textmsg,
            'utm_source' => $this->utm_source,
            'utm_medium' => $this->utm_medium,
            'utm_campaign' => $this->utm_campaign
        ]);

        $file = new FileController();
        $file->createJavaScriptFile();
        $this->closeAdvance('advanceoptions');
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


        $this->textmsg = $this->phone->tracking->textmsg;
        $this->callerid = 'tracking';
        if ($this->analytics == "auto") {
            $this->initialize(1);
        }
    }
    public function initialize($flag)
    {
        if ($flag) {
            $this->utm_source = $this->phone->tracking->utm_source;
            $this->utm_medium = $this->phone->tracking->utm_medium;
            $this->utm_campaign = $this->phone->tracking->utm_campaign;
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
        } else {
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
