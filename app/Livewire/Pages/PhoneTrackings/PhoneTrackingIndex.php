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

    public $phoneSets = [];

    public $phoneNumbers = [];
    public $deactivated = [];
    public int $phoneNumbersCount;
    public int $deactivatedCount;

    public bool $active = true;
    public string $search = "";
    public int $toDisplay = 2;
    protected $listeners = [
        'phoneTrackingIndexRefresh' => '$refresh',
    ];


    public function showToDisplay(string $value)
    {
        $this->toDisplay = $value;
    }
    public function showPhoneNumber(bool $value)
    {
        $this->search = "";
        $this->active = $value;
    }
    public function mount()
    {
        // $xmlBins = SignalWire::http("/api/laml/2010-04-01/Accounts/" . env("SIGNALWIRE_PROJECTID") . "/LamlBins");

        // $this->phoneNumbers = SignalWire::http('/api/relay/rest/phone_numbers');

        // $this->phoneNumbers = Phonenumbers::where('company_id', auth()->user()->company_id)->get();

        $this->phoneNumbers = Phonenumbers::where('company_id', auth()->user()->company_id)
            ->where(function ($query) {
                $query->orWhere('number', 'like', "%{$this->search}%")
                    ->orWhere('name', 'like', "%{$this->search}%");
            })
            ->get();
        $this->phoneNumbersCount = Phonenumbers::where('company_id', auth()->user()->company_id)->count();
        $this->deactivated = Phonenumbers::where('company_id', auth()->user()->company_id)->onlyTrashed()->get();
        $this->deactivatedCount = Phonenumbers::where('company_id', auth()->user()->company_id)->onlyTrashed()->count();
        // dd($this->phoneNumbers);
        // foreach ($this->phoneNumbers['data'] as $phoneNumber) {
        //     if (Phonenumbers::where('id', $phoneNumber['id'])->exists()) {
        //         continue;
        //     }

        //     Phonenumbers::create([
        //         'id' => $phoneNumber['id'],
        //         'name' => $phoneNumber['name'],
        //         'number' => PhoneFormatService::format($phoneNumber['number']),
        //         'company_id' => auth()->user()->company_id
        //     ]);
        // }

        foreach ($this->phoneNumbers as $key => $pn) {


            $this->phoneSets[$key]['sets'] = Schedule::where('id', $pn->id)
                ->groupBy('id', 'sets')
                ->get()
                ->count();

            $this->phoneSets[$key]['number'] = $pn->number;
        }
    }

    public function render()
    {
        $this->phoneNumbers = Phonenumbers::where('company_id', auth()->user()->company_id)
            ->where(function ($query) {
                $query->orWhere('number', 'like', "%{$this->search}%")
                    ->orWhere('name', 'like', "%{$this->search}%");
            })
            ->get();


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
