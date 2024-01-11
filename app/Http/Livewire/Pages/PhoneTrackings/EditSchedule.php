<?php

namespace App\Http\Livewire\Pages\PhoneTrackings;

use Livewire\Component;
use App\Integrations\SignalWire;
use App\Models\Schedules; // Try to link to "Phonenumbers" to get all the schedules
use Illuminate\Console\Scheduling\Schedule;

class EditSchedule extends Component
{
    public $pid, $pname, $pnumber;

    public $schedules = [];

    public $sets = 0;

    public $monstartsched=[], $tuestartsched=[],$wedstartsched=[],$thustartsched=[],$fristartsched=[],$satstartsched=[],$sunstartsched= [];

    public $monendsched=[], $tueendsched=[],$wedendsched=[],$thuendsched=[],$friendsched=[],$satendsched=[],$sunendsched = [];

    public $fwd = [];

    public function mount($id){
        $phoneInfo = SignalWire::http("/api/relay/rest/phone_numbers/" . $id);
        $this->pid = $phoneInfo['id'];
        $this->pname =  $phoneInfo['name'];
        $this->pnumber =  $phoneInfo['number'];

        $this->schedules = Schedules::where('phone_id', $phoneInfo['id'])->get();
        $this->sets =  Schedules::select(Schedules::raw('count(sets) as user_count'))
        ->groupBy('sets')->where('phone_id', $this->pid)->get()->count();

        foreach($this->schedules as $sched){
            $this->setStartSched($sched['day'], $sched['sets'],$sched['start_sched']);
            $this->setEndSched($sched['day'], $sched['sets'],$sched['end_sched'], $sched['fwd_number']);
            //Add call flow
        }

    }
    public function render()
    {
        return view('livewire.pages.phone-trackings.edit-schedule');
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
    private function setStartSched($day, $set, $val){
        switch ($day) {
            case 1:
                $this->monstartsched[$set] = $val;
                break;
            case 2:
                $this->tuestartsched[$set] = $val;
                break;
            case 3:
                $this->wedstartsched[$set] = $val;
                break;
            case 4:
                $this->thustartsched[$set] = $val;
                break;
            case 5:
                $this->fristartsched[$set] = $val;
                break;
            case 6:
                $this->satstartsched[$set] = $val;
                break;
            case 7:
                $this->sunstartsched[$set] = $val;
                break;
            default:
                break;
            }
    }

    private function setEndSched($day, $set, $val, $fwd){
        switch ($day) {
            case 1:
                $this->monendsched[$set] = $val;
                break;
            case 2:
                $this->tueendsched[$set] = $val;
                break;
            case 3:
                $this->wedendsched[$set] = $val;
                break;
            case 4:
                $this->thuendsched[$set] = $val;
                break;
            case 5:
                $this->friendsched[$set] = $val;
                break;
            case 6:
                $this->satendsched[$set] = $val;
                break;
            case 7:
                $this->fwd[$set] = $fwd;
                $this->sunendsched[$set] = $val;
                break;
            default:
                break;
            }
    }
}
