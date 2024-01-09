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
            $this->phoneNumbers['data'][$key]['number'] = $this->beautifyPhoneNumber($pn['number']);
        }
    }

    public function render()
    {
        return view('livewire.pages.phone-trackings.phone-tracking-index');
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

        $this->openForm('forms.phone-trackings.edit-phone-number', 'edit', $phoneInfo);
    }

    public function addPhoneNum($id)
    {
        return to_route('phone-settings-add-schedule', ['id' => $id]);
    }

    private function beautifyPhoneNumber($number)
    {
        return substr($number, 2, 3) . '-' . substr($number, 5, 3) . '-' . substr($number, 8, 4);
    }
}
