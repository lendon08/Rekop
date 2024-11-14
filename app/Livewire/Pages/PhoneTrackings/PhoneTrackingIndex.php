<?php

namespace App\Livewire\Pages\PhoneTrackings;

use App\Livewire\Traits\WithForm;
use App\Livewire\Traits\WithToast;
use App\Integrations\SignalWire;
use App\Models\Phonenumbers;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule;
use App\Services\PhoneFormatService;
use Livewire\Attributes\Title;

#[Title('Phone Settings')]
class PhoneTrackingIndex extends Component
{
    use WithForm, WithToast;

    public $phoneNumbers = [];


    protected $listeners = [
        'phoneTrackingIndexRefresh' => '$refresh',
    ];

    //TODO
    public function mount()
    {
        // $xmlBins = SignalWire::http("/api/laml/2010-04-01/Accounts/" . env("SIGNALWIRE_PROJECTID") . "/LamlBins");


        // dd($xmlBins);
        $this->phoneNumbers = SignalWire::http('/api/relay/rest/phone_numbers');
        // dd($this->phoneNumbers);
        foreach ($this->phoneNumbers['data'] as $phoneNumber) {
            if (Phonenumbers::where('id', $phoneNumber['id'])->exists()) {
                continue;
            }

            Phonenumbers::create([
                'id' => $phoneNumber['id'],
                'name' => $phoneNumber['name'],
                'number' => PhoneFormatService::format($phoneNumber['number']),
                'company_id' => auth()->user()->company_id
            ]);
        }

        foreach ($this->phoneNumbers['data'] as $key => $pn) {


            $this->phoneNumbers['data'][$key]['sets'] = Schedule::where('id', $pn['id'])
                ->groupBy('id', 'sets')
                ->get()
                ->count();

            $this->phoneNumbers['data'][$key]['number'] = $this->beautifyPhoneNumber($pn['number']);
        }
    }

    public function render()
    {

        return view('livewire.pages.phone-trackings.phone-tracking-index');
    }


    public function viewPhoneNum()
    {
        $this->openForm('forms.phone-trackings.view-phone-number');
    }

    public function editPhoneNum($id)
    {
        return to_route('edit-schedule', ['id' => $id]);
    }

    public function addPhoneNum($id)
    {
        return to_route('add-schedule', ['id' => $id]);
    }
    public function editPhoneTracking($id)
    {
        return to_route('edit-phonetracking', ['id' => $id]);
    }

    private function beautifyPhoneNumber($number)
    {
        return substr($number, 2, 3) . '-' . substr($number, 5, 3) . '-' . substr($number, 8, 4);
    }
}
