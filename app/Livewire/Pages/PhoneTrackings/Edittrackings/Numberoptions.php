<?php

namespace App\Livewire\Pages\PhoneTrackings\Edittrackings;

use App\Http\Controllers\FileController;
use App\Models\Phonenumbers;
use App\Models\Phonetracking;
use Livewire\Attributes\On;
use Livewire\Component;

class Numberoptions extends Component
{
    public $numberOptions = true;

    public $id = "";

    public $phone;


    public $name;
    public $number;
    public $whisperF;
    public $callgreetingF;
    public $whisper = "";
    public $recordingF;
    public $callgreeting;
    public $swaptarget;
    public $campaign = "";
    public $autoreply;

    #[On('toggleNumberOption')]
    public function toggle($data)
    {
        $this->numberOptions = $data;
    }

    public function closeNumber($toggle)
    {
        $this->dispatch('toggleParent', toggle: $toggle);
    }

    public function NumberOptionSave()
    {
        $this->phone->name = $this->name;
        $this->phone->number = $this->number;
        $this->phone->save();

        if (!$this->whisperF) {
            $this->whisper = "";
        }
        if (!$this->callgreetingF) {
            $this->callgreeting = "";
        }
        Phonetracking::where('phonenumber_id', $this->id)->update([
            'whispermsg' => $this->whisper,
            'swaptarget' => $this->swaptarget,
            'recordingflag' => $this->recordingF,
            'callgreeting' => $this->callgreeting,
            'campaignname' => $this->campaign,
            'autoreply' => $this->autoreply

        ]);

        $file = new FileController();
        $file->createJavaScriptFile();
        $this->closeNumber('numberOptions');
        $this->dispatch('showtoast', 'Number Options Saved');
    }
    public function mount($data, $phone, $id)
    {
        $this->id = $id;
        $this->phone = $phone;
        $this->numberOptions = $data;
        $this->name = $this->phone->name;
        $this->number = $this->phone->tracking->callforwarding;
        $this->swaptarget = $this->phone->tracking->swaptarget;
        $this->whisperF = $this->phone->tracking->whisper ? true : false;
        $this->callgreetingF = $this->phone->tracking->callgreeting ? true : false;
        $this->callgreeting = $this->phone->tracking->callgreeting;
        $this->recordingF = $this->phone->tracking->recordingflag;
        $this->autoreply = $this->phone->tracking->autoreply;
    }
    public function render()
    {
        // dd($this->callgreeting);
        $this->phone = Phonenumbers::find($this->id);
        return view('livewire.pages.phone-trackings.edittrackings.numberoptions');
    }
}
