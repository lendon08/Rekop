<?php

namespace App\Livewire\Pages\PhoneTrackings;

use App\Livewire\Traits\WithForm;
use App\Integrations\SignalWire;
use App\Models\Company;
use Livewire\Component;

class PhoneTrackingReport extends Component
{   

    use WithForm;

    public bool $readyToDisplayCalls = false;

    public bool $readyToPlay = false;

    public bool $playRecording = false;

    public ?string $currentRecording = null;

    public ?string $currentPlayButton = null;

    public Company $selectedCompany;

    public int $numOfCall = 0;

    public int $numOfUniqueCall = 0;

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'playRecordingEnded' => 'playRecordingEnded'
    ];

    public function mount($company)
    {
        $this->selectedCompany = Company::where('id', $company)->first();
    }

    public function render()
    {
        $calls = SignalWire::http($this->selectedCompany, '/api/laml/2010-04-01/Accounts/'.$this->selectedCompany->project_id.'/Calls??Status=completed');

        $this->numOfCall = count($calls['calls'] ?? []);

        $uniqueCalls = [];
        foreach ($calls['calls'] as $call) {
            if (isset($call['to'])) {
                $uniqueCalls[] = $call['to'];
            }
        }

        $this->numOfUniqueCall = count(array_unique($uniqueCalls) ?? []);

        return view('components.livewire.pages.phone-trackings.phone-tracking-report', [
            'calls' => $calls ?? ['calls' => []],
        ]);
    }

    public function loadCalls()
    {
        $this->readyToDisplayCalls = true;
    }

    public function playRecordingEnded()
    {
        $this->readyToPlay = false; 
    }

    public function playRecording(string $currentPlayButton, string $recordingUri)
    {   
        $this->openForm('forms.companies.company-form');

        // $this->currentRecording = null;

        // $this->readyToPlay = false;

        // $this->playRecording = true;

        // $this->currentPlayButton = $currentPlayButton;
        
        // $recordings = SignalWire::http($this->selectedCompany, $recordingUri);

        // if (isset($recordings['recordings']) && count($recordings['recordings']) > 0) {
        //     $currentRecording = array_pop($recordings['recordings']);
        //     if (isset($currentRecording['uri'])) {
        //         $lastJsonPos = strrpos($currentRecording['uri'], '.json');
        //         $this->currentRecording = 'https://'.$this->selectedCompany->space_url.substr_replace($currentRecording['uri'], '.mp3', $lastJsonPos);
        //     }
        // }

        // $this->readyToPlay = true;

        // $this->playRecording = false; 

        // $this->dispatch('playAudio');

        $this->dispatch('refreshComponent');

    }
    
}
