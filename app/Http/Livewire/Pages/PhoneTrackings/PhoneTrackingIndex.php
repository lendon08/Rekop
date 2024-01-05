<?php

namespace App\Http\Livewire\Pages\PhoneTrackings;

use App\Http\Livewire\Traits\WithForm;
use App\Http\Livewire\Traits\WithToast;
use App\Integrations\SignalWire;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class PhoneTrackingIndex extends Component
{
    use WithForm, WithToast;

    public $flashmessage = "";
    public $xmlBins = [];
    public $phoneNumbers = [];
    protected $listeners = [
        'phoneTrackingIndexRefresh' => '$refresh',
    ];

    public function mount()
    {
        $this->xmlBins = SignalWire::http("/api/laml/2010-04-01/Accounts/" . env("SIGNALWIRE_PROJECTID") . "/LamlBins");
        $this->phoneNumbers = SignalWire::http('/api/relay/rest/phone_numbers');
        // dd($this->phoneNumbers);

        foreach ($this->phoneNumbers['data'] as $key => $pn) {
            //IMPORTANT

            //1. REDO and put in a button(Refresh if there is new phone number added)

            //2. Check time and add Currently used on the side of bin.

            // $this->storeID($pn);
            $this->phoneNumbers['data'][$key]['number'] = $this->beautifyPhoneNumber($pn['number']);
            $this->phoneNumbers['data'][$key]['schedule'] = $this->getSchedule($pn['id']);
        }
    }
    public function render()
    {
        return view('livewire.pages.phone-trackings.phone-tracking-index');
    }
    public function hydrate()
    {
        foreach ($this->phoneNumbers['data'] as $key => $pn) {
            $this->phoneNumbers['data'][$key]['schedule'] = $this->getSchedule($pn['id']);
        }
    }

    public function createPhoneNum()
    {
        $this->openForm('forms.phone-trackings.add-phone-number');
    }

    public function viewPhoneNum()
    {
        $this->openForm('forms.phone-trackings.view-phone-number');
    }
    public function editPhoneNum($id)
    {

        $phoneInfo = SignalWire::http("/api/relay/rest/phone_numbers/" . $id);
        $xmlBins = SignalWire::http("/api/laml/2010-04-01/Accounts/" . env("SIGNALWIRE_PROJECTID") . "/LamlBins");
        $phoneInfo['bins'] = $xmlBins['laml_bins'];
        $phoneInfo['schedule'] = $this->getSchedule($id);

        $this->openForm('forms.phone-trackings.edit-phone-number', 'create', $phoneInfo);
    }



    private function getSchedule($id): array
    {
        $phoneSchedules = json_decode(DB::table('phonenumbers')->where('phone_id', $id)->get(), true);
        $schedule = [];

        foreach ($phoneSchedules as $index => $phoneSchedule) {
            $schedule[$index] = $phoneSchedule;
            $schedule[$index]['bin_name'] = $this->checkBinName($phoneSchedule['call_request_url'], $this->xmlBins['laml_bins']);
        }
        // dd($schedule);
        return $schedule;
    }

    private function storeID($pn)
    {
        if (DB::table('phonenumbers')->where('phone_id', $pn['id'])->doesntExist()) {
            DB::insert(
                'insert into phonenumbers
            (phone_id, name, number, call_request_url,
            start_sched, end_sched)
            values (? , ? , ? , ? , ? , ? )',
                [
                    $pn['id'], $pn['name'], $pn['number'], $pn['call_request_url'],
                    '00:00', '00:00'
                ]
            );
        }
    }

    private function checkBinName($id, $bins)
    {
        foreach ($bins as $bin) {
            if ($bin['request_url'] == $id)
                return $bin['name'];
        }
    }
    private function beautifyPhoneNumber($number)
    {
        return substr($number, 2, 3) . '-' . substr($number, 5, 3) . '-' . substr($number, 8, 4);
    }
}
