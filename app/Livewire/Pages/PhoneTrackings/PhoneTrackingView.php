<?php

namespace App\Livewire\Pages\PhoneTrackings;

use App\Integrations\SignalWire;
use App\Models\Company;
use Livewire\Component;

class PhoneTrackingView extends Component
{
    public function mount($company, $phone)
    {
        $selectedCompany = Company::where('id', $company)->first();
        $phoneNumbers = SignalWire::http($selectedCompany, '/api/laml/2010-04-01/Accounts/' . $selectedCompany->project_id . '/Calls??Status=completed');

        $recordings = array();

        foreach ($phoneNumbers['calls'] as $call) {

            $recording = SignalWire::http($selectedCompany, $call['uri'] . '/Recordings');

            if ($recording['recordings']) {
                $recordings[] = $recording['recordings'];
            }
        }
    }

    public function render()
    {
        return view('livewire.pages.phone-trackings.phone-tracking-view');
    }
}
