<?php

namespace App\Http\Livewire\Pages\PhoneTrackings;

use Livewire\Component;
use App\Integrations\SignalWire;
use App\Models\Schedules; // Try to link to "Phonenumbers" to get all the schedules
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;

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
        // $this->sets =  Schedules::select(Schedules::raw('count(sets) as user_count'))
        // ->groupBy('sets')->where('phone_id', $this->pid)->get()->count();
        config(['database.connections.mysql.strict' => false]);
        DB::reconnect();
        $this->sets =  Schedules::groupBy('sets')->where('phone_id', $this->pid)->get()->count();

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
    public function create(){
        session(['title' => 'Successfully Updated Schedule']);

        return to_route('phone-settings');
        foreach ($this->fwd as $key => $fwds) {
            for($val=1; $val<=7; $val++){
               Schedules::where('phone_id', $this->pid)
                ->where('fwd_number', $fwds)
                ->where('sets', $key)
                ->where('day', $val)
                ->update([
                    'start_sched' => $this->getStartSched($val, $key),
                    'end_sched' => $this->getEndSched($val, $key),
                    'fwd_number' => $fwds
                ]);

            }
        }

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
