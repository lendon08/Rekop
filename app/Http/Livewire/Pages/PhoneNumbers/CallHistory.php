<?php

namespace App\Http\Livewire\Pages\PhoneNumbers;

use App\Integrations\SignalWire;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;


class CallHistory extends Component
{
    use WithPagination;

    public $selectAll = false;

    public $selectedItems = [];

    public $phoneNumbers = []; // Your custom array of users

    public $sortField = 'name'; // Default sorting field

    public $sortDirection = 'asc'; // Default sorting direction

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

        // For all calls
        $calls = SignalWire::http($this->selectedCompany, '/api/laml/2010-04-01/Accounts/' . env('SIGNALWIRE_PROJECTID') . '/Calls??Status=completed');
        $this->numOfCall = count($calls['calls'] ?? []);


        $uniqueCalls = [];
        foreach ($calls['calls'] as $call) {
            if (isset($call['to'])) {
                $uniqueCalls[] = $call['to'];
            }
        }

        $this->numOfUniqueCall = count(array_unique($uniqueCalls) ?? []);

        $this->phoneNumbers = collect($calls['calls'] ?? []);



        // Only have recording
        // $calls = SignalWire::http($this->selectedCompany, '/api/laml/2010-04-01/Accounts/'.env('SIGNALWIRE_PROJECTID').'/Recordings');
        // dd($calls);
        // $this->numOfCall = count($calls['calls'] ?? []);


        // $uniqueCalls = [];
        // foreach ($calls['recordings'] as $call) {
        //     if (isset($call['to'])) {
        //         $uniqueCalls[] = $call['to'];
        //     }
        // }

        // $this->numOfUniqueCall = count(array_unique($uniqueCalls) ?? []);


        // $this->phoneNumbers = collect($calls['recordings'] ?? []);
        // dd($this->phoneNumbers);


    }

    public function render()
    {
        $sortedUsers = $this->phoneNumbers ?? [];


        if ($this->sortDirection === 'desc') {
            $sortedUsers =  $sortedUsers->sortByDesc($this->sortField);
        } else {
            $sortedUsers =  $sortedUsers->sortBy($this->sortField);
        }

        $sortedUsers =  $sortedUsers->all();

        $perPage = 10; // Display 10 users per page
        $currentPage = $this->page ?: 1;
        $offset = ($currentPage - 1) * $perPage;

        $paginatedUsers = new LengthAwarePaginator(
            array_slice($sortedUsers, $offset, $perPage, true),
            count($sortedUsers),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('livewire.pages.phone-numbers.call-history', [
            'calls' => $paginatedUsers,
        ]);
    }

    public function sortBy($field)
    {
        if ($field === $this->sortField) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = collect($this->phoneNumbers)->pluck('sid')->all();
        } else {
            $this->selectedItems = [];
        }
    }

    public function playRecordingEnded()
    {
        $this->readyToPlay = false;
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

    public function generateReport()
    {
        $collection = $this->phoneNumbers;
        $sidArray = $this->selectedItems;

        $filteredCollection = $collection->filter(function ($item) use ($sidArray) {
            return in_array($item['sid'], $sidArray);
        })->toArray();

        //todo
        // $tempURL = URL::temporarySignedRoute('call-history-reports', now()->addMinutes(5), ['company' => $this->selectedCompany->id, 'calls' =>  json_encode($filteredCollection)]);
        // view()->share('company', $this->selectedCompany->id);

        return redirect()->route(
            'call-history-reports',
            [
                'company' => $this->selectedCompany->id,
                'calls' =>  json_encode($filteredCollection)

            ],
        );
    }
}
