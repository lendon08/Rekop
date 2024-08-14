<?php

namespace App\Livewire\Pages\PhoneNumbers;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Integrations\SignalWire;
use App\Models\Company;


class CallHistoryReport extends Component
{
    public $phoneNumbers = [];

    public ?string $currentRecording = null;

    public ?string $currentPlayButton = null;

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'playRecordingEnded' => 'playRecordingEnded'
    ];

    public bool $readyToPlay = false;

    public int $numOfCall = 0;

    public $calls = array();
    public Company $selectedCompany;

    public function mount(Request $request)
    {

        //something is wrong in here
        // $this->selectedCompany = Company::where('id', 1)->first();


        $this->phoneNumbers = json_decode($request->calls, true);
        $this->numOfCall = count($this->phoneNumbers ?? []);


        foreach ($this->phoneNumbers as $key => $sid) {

            array_push(
                $this->calls,
                SignalWire::http('/api/laml/2010-04-01/Accounts/' . env('SIGNALWIRE_PROJECTID') . '/Calls/' . $sid)
            );
        }
        // dd($this->calls);


        // $this->tempURL = $request->tempURL;
    }

    public function render()
    {
        $total = array_sum(array_column($this->phoneNumbers, 'price'));
        return view('components.livewire.pages.phone-numbers.call-history-report', [
            'calls' => $this->phoneNumbers,
            'multiplier' => $this->selectedCompany->toArray()['lead_value'],
            'total' => $total,
        ]);
    }

    public function playRecordingEnded()
    {
        $this->readyToPlay = false;
    }


    public function paymentReport()
    {
        //To do in here
        dd('Connect stripe payment');
    }

    public function playRecording(string $currentPlayButton, string $recordingUri)
    {
        $this->currentRecording = null;

        $this->readyToPlay = false;

        $this->playRecording = true;

        $this->currentPlayButton = $currentPlayButton;

        $recordings = SignalWire::http($this->selectedCompany, $recordingUri);

        if (isset($recordings['recordings']) && count($recordings['recordings']) > 0) {
            $currentRecording = array_pop($recordings['recordings']);
            if (isset($currentRecording['uri'])) {
                $lastJsonPos = strrpos($currentRecording['uri'], '.json');
                $this->currentRecording = 'https://' . env('SIGNALWIRE_SPACE_URL') . substr_replace($currentRecording['uri'], '.mp3', $lastJsonPos);
            }
        }

        $this->readyToPlay = true;

        $this->playRecording = false;

        $this->dispatch('playAudio');

        $this->dispatch('refreshComponent');
    }
}
