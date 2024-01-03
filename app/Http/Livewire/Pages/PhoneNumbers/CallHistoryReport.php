<?php

namespace App\Http\Livewire\Pages\PhoneNumbers;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Integrations\SignalWire;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class CallHistoryReport extends Component
{
    public $phoneNumbers = [];

    public bool $playRecording;

    public ?string $currentRecording = null;

    public ?string $currentPlayButton = null;

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'playRecordingEnded' => 'playRecordingEnded'
    ];

    public bool $readyToPlay = false;

    public int $numOfCall = 0;

    public $calls= array();
    public Company $selectedCompany;
    
    public $multiply= 50;
    public $total =0;

    public function mount(Request $request)
    {
        
        //something is wrong in here
        // $this->selectedCompany = Company::where('id', 1)->first();
        
       
        $this->phoneNumbers = Str::of($request->call)->trim('[]')->replace('"', '')->explode(',');
        
        $this->numOfCall = 2;
        // count($this->phoneNumbers ?? []);


        foreach($this->phoneNumbers as $sid){
            $this->calls[]= SignalWire::http('/api/laml/2010-04-01/Accounts/'. env('SIGNALWIRE_PROJECTID') . '/Calls/'.$sid);
        }

        $this->total = array_sum(array_column($this->calls, 'price'));

        // $this->tempURL = $request->tempURL;
    }

    public function render()
    {
        return view('livewire.pages.phone-numbers.call-history-report')->layout('layouts.report');
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

        $this->dispatchBrowserEvent('playAudio');

        $this->dispatchBrowserEvent('refreshComponent');
    }
}
