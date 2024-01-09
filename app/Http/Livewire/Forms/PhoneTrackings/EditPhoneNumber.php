<?php

namespace App\Http\Livewire\Forms\PhoneTrackings;

use App\Http\Livewire\Traits\WithForm;
use App\Http\Livewire\Traits\WithToast;
use App\Integrations\SignalWire;
use Faker\Provider\bg_BG\PhoneNumber;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Phonenumbers;

class EditPhoneNumber extends Component
{

    use WithForm, WithToast;



    public $action = "";

    public $name;

    public $schedules = [];

    public $schedid = [];

    public $xmlbins = [];

    public $startsched = [];

    public $endsched = [];

    public $fwd = [];

    public $i = 0;

    public $pnid, $pnname, $pnnumber;
    public function mount($action, $data)
    {
        $this->pnid = $data['id'];
        $this->pnname = $data['name'];
        $this->pnnumber = $data['number'];
        $this->action = $action;
        $this->name = $data['name'];
        $this->schedules = $data['schedule'];

        foreach ($this->schedules as $key => $sched) {
            // dd($sched['fwd']);
            $this->startsched[$key] = $this->arrangeTime($sched['start_sched']);
            $this->endsched[$key] = $this->arrangeTime($sched['end_sched']);
            $this->xmlbins[$key] = $sched['bin_name']; // Needed
            $this->schedid[$key] = $sched['id'];
            $this->fwd[$key] = $sched['fwd'];
            $this->i = $key;
        }
    }

    public function formatNumber($key)
    {
        $num  = $this->fwd[$key];
        $num = preg_replace('/[^0-9]+/', '', $num);
        $num = substr($num, 0, 11);
        $length = strlen($num);
        $formatted = "";
        for ($i = 0; $i < $length; $i++) {
            $formatted .= $num[$i];
            if ($i == 3 || $i == 6) {
                $formatted .= "-";
            }
        }

        $this->fwd[$key] = $formatted;
    }
    public function addSchedule($i)
    {
        $this->i = $i + 1;
        array_push($this->schedules, $i);
    }
    public function removeSchedule($i)
    {
        //check if it i
        unset($this->schedules[$i]);
        unset($this->startsched[$i]);
        unset($this->endsched[$i]);
        unset($this->fwd[$i]);
        $i = $i - 1;
        $this->i = $i;
    }
    private function arrangeTime($time)
    {
        return date('H:i', strtotime($time));
    }

    public function create()
    {
        if (empty($this->schedid)) {
            foreach ($this->schedules as $key => $id) {
                Phonenumbers::insert([
                    'phone_id' => $this->pnid,
                    'name' => $this->pnname,
                    'number' => $this->pnnumber,
                    'start_sched' => $this->startsched[$key],
                    'end_sched' => $this->endsched[$key],
                    'fwd' => $this->fwd[$key]
                ]);
            }
        } else {
            // foreach ($this->schedules as $key => $id) {
            // if (Phonenumbers::where('id', $id)->exists()) {
            //     dd("exist");
            //     Phonenumbers::where('id', $id)
            //         ->update([
            //             'start_sched' => $this->startsched[$key],
            //             'end_sched' => $this->endsched[$key],
            //             'fwd' => $this->fwd[$key]
            //         ]);
            // } else {
            //     dd("not");
            // }
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
