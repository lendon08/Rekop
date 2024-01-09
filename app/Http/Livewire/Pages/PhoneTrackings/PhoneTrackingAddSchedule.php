<?php

namespace App\Http\Livewire\Pages\PhoneTrackings;

use Livewire\Component;
use App\Integrations\SignalWire;
use App\Models\Phonenumbers;
use App\Models\Schedules;
use App\Http\Livewire\Traits\WithToast;


class PhoneTrackingAddSchedule extends Component
{
    use WithToast;

    public $PhoneID = "";

    public $action = "";

    public $schedules = [];

    public $schedid = [];

    public $xmlbins = [];

    public $monstartsched=[], $tuestartsched=[],$wedstartsched=[],$thustartsched=[],$fristartsched=[],$satstartsched=[],$sunstartsched= [];

    public $monendsched=[], $tueendsched=[],$wedendsched=[],$thuendsched=[],$friendsched=[],$satendsched=[],$sunendsched = [];

    public $fwd = [];

    public $i = 0;

    public $pnid, $pnname, $pnnumber;

    public $sets = 0;


    public function mount($id)
    {
        $this->PhoneID = $id;
        if (!Phonenumbers::where('phone_id', $id)->exists()) {
            $phoneInfo = SignalWire::http("/api/relay/rest/phone_numbers/" . $id);

            Phonenumbers::insert([
                'phone_id' => $phoneInfo['id'],
                'name' => $phoneInfo['name'],
                'number' => $phoneInfo['number'],

            ]);
            $this->pnid = $phoneInfo['id'];
            $this->pnname = $phoneInfo['name'];
            $this->pnnumber = $phoneInfo['number'];
        }else{
            $phoneInfo = Phonenumbers::where('phone_id', $id)->first();
            $this->pnid = $phoneInfo->phone_id;
            $this->pnname = $phoneInfo->name;
            $this->pnnumber = $phoneInfo->number;
        }
        $this->sets =  Schedules::select(Schedules::raw('count(sets) as user_count'))
        ->groupBy('sets')->get()->count();

    }
    public function render()
    {
        return view('livewire.pages.phone-trackings.phone-tracking-add-schedule');
    }

    public function addSchedule($i)
    {
        $this->i = $i + 1;
        array_push($this->schedules, $i);
        array_push($this->monstartsched, "00:00");
        array_push($this->tuestartsched, "00:00");
        array_push($this->wedstartsched, "00:00");
        array_push($this->thustartsched, "00:00");
        array_push($this->fristartsched, "00:00");
        array_push($this->satstartsched, "00:00");
        array_push($this->sunstartsched, "00:00");

        array_push($this->monendsched, "00:00");
        array_push($this->tueendsched, "00:00");
        array_push($this->wedendsched, "00:00");
        array_push($this->thuendsched, "00:00");
        array_push($this->friendsched, "00:00");
        array_push($this->satendsched, "00:00");
        array_push($this->sunendsched, "00:00");
    }

    public function removeSchedule($i)
    {
        $i = $i - 1;
        $this->i = $i;
        unset($this->schedules[$i]);
        unset($this->fwd[$i]);

         unset($this->monstartsched[$i]);
         unset($this->tuestartsched[$i]);
         unset($this->wedstartsched[$i]);
         unset($this->thustartsched[$i]);
         unset($this->fristartsched[$i]);
         unset($this->satstartsched[$i]);
         unset($this->sunstartsched[$i]);

         unset($this->monendsched[$i]);
         unset($this->tueendsched[$i]);
         unset($this->wedendsched[$i]);
         unset($this->thuendsched[$i]);
         unset($this->friendsched[$i]);
         unset($this->satendsched[$i]);
         unset($this->sunendsched[$i]);
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

    private function arrangeTime($time)
    {
        return date('H:i', strtotime($time));
    }

    public function getStartSched($val, $key){
        switch ($val) {
            case 1:
                return $this->monstartsched[$key];
                break;
            case 2:
                return $this->tuestartsched[$key];
                break;
            case 3:
                return $this->wedstartsched[$key];
                break;
            case 4:
                return $this->thustartsched[$key];
                break;
            case 5:
                return $this->fristartsched[$key];
                break;
            case 6:
                return $this->satstartsched[$key];
                break;
            case 7:
                return $this->sunstartsched[$key];
                break;
            default:
                break;
            }
    }
    public function getEndSched($val, $key){
        switch ($val) {
            case 1:
                return $this->monendsched[$key];
                break;
            case 2:
                return $this->tueendsched[$key];
                break;
            case 3:
                return $this->wedendsched[$key];
                break;
            case 4:
                return $this->thuendsched[$key];
                break;
            case 5:
                return $this->friendsched[$key];
                break;
            case 6:
                return $this->satendsched[$key];
                break;
            case 7:
                return $this->sunendsched[$key];
                break;
            default:
                break;
            }
    }
    public function create()
    {


         foreach($this->schedules as $key => $sched){

            for($val=1; $val<=7; $val++){
                Schedules::insert([
                    'phone_id' => $this->pnid,
                    'fwd_number' => $this->fwd[$key],
                    'sets' => $key + 1 + $this->sets,
                    'day' => $val,
                    'callflow' =>'ring through',
                    'call_request_url'=>'',
                    'start_sched' => $this->getStartSched($val, $key),
                    'end_sched' => $this->getEndSched($val, $key)
                ]);
            }
         }
        // if (empty($this->schedid)) {
        //     foreach ($this->schedules as $key => $id) {
        //
        //     }
        // } else {
        //     // foreach ($this->schedules as $key => $id) {
        //     // if (Phonenumbers::where('id', $id)->exists()) {
        //     //     dd("exist");
        //     //     Phonenumbers::where('id', $id)
        //     //         ->update([
        //     //             'start_sched' => $this->startsched[$key],
        //     //             'end_sched' => $this->endsched[$key],
        //     //             'fwd' => $this->fwd[$key]
        //     //         ]);
        //     // } else {
        //     //     dd("not");
        //     // }
        // }

        // session(['title' => 'Success', 'message' => 'Call Forwarding settings has been updated!']);



        return to_route('phone-settings');
    }
}
