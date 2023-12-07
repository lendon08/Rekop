<?php

namespace App\Http\Livewire\Pages\PhoneTrackings;

use App\Http\Livewire\Traits\WithForm;
use App\Integrations\SignalWire;
use App\Models\Company;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Carbon;

class PhoneTrackingIndex extends Component
{
    use WithForm;

    public $selectedCompanyID;

    protected $listeners = [
        'phoneTrackingIndexRefresh' => '$refresh',
    ];

    public function render()
    {
        $companies = Company::paginate();

        $selectedCompany = Company::query();

        if ($this->selectedCompanyID > 0 ) {
            $selectedCompany = $selectedCompany->where('id', $this->selectedCompanyID);
        }

        $selectedCompany = $selectedCompany->first();

        $phoneNumbers = SignalWire::http($selectedCompany, '/api/relay/rest/phone_numbers');

        return view('livewire.pages.phone-trackings.phone-tracking-index', compact('companies', 'phoneNumbers', 'selectedCompany'));
    }

    public function createPhoneNum()
    {
        $this->openForm('forms.phone-trackings.add-phone-number');
    }

    public function viewPhoneNum()
    {
        $this->openForm('forms.phone-trackings.view-phone-number');
    }

}
