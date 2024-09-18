<?php

namespace App\Livewire\Pages\PhoneTrackings;

use App\Livewire\Traits\WithForm;
use App\Livewire\Traits\WithToast;
use App\Integrations\SignalWire;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule;
use Livewire\Attributes\Title;

#[Title('Phone Settings')]
class Index extends Component
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

        foreach ($this->phoneNumbers['data'] as $key => $pn) {
            //wtf is this. 
            config(['database.connections.mysql.strict' => false]);
            DB::reconnect();
            $this->phoneNumbers['data'][$key]['sets'] = Schedule::groupBy('sets')->where('id', $pn['id'])->get()->count();
            $this->phoneNumbers['data'][$key]['number'] = $this->beautifyPhoneNumber($pn['number']);
        }
    }

    public function render()
    {

        return view('livewire.pages.phone-trackings.index');
    }

    public function buyPhoneNum()
    {
        return to_route('wizard');
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

    private function beautifyPhoneNumber($number)
    {
        return substr($number, 2, 3) . '-' . substr($number, 5, 3) . '-' . substr($number, 8, 4);
    }
}
