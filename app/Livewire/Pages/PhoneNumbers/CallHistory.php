<?php

namespace App\Livewire\Pages\PhoneNumbers;

use App\Livewire\Traits\WithToast;
use App\Integrations\SignalWire;
use App\Models\Callhistory as ModelsCallhistory;
use App\Models\Company;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Title;
use Livewire\Attributes\Renderless;

#[Title('Call History')]
class CallHistory extends Component
{

    use WithPagination, WithToast;

    // public $selectAll = false;

    // public $selectedItems = [];

    public $phoneNumbers = []; // Your custom array of users

    public $sortColumn = 'call_date'; // Default sorting field

    public $sortDirection = 'desc'; // Default sorting direction

    public bool $readyToDisplayCalls = false;

    public bool $readyToPlay = false;

    public bool $playRecordingBool = false;

    public ?string $currentRecording = null;

    public ?string $currentPlayButton = null;

    public Company $selectedCompany;

    public int $numOfCall = 0;

    public int $numOfUniqueCall = 0;

    public int $page = 0;

    public string $search = "";

    public $targetDate;
    public $startDate;

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'playRecordingEnded' => 'playRecordingEnded'
    ];


    public function mount()
    {
        // $calls = SignalWire::http('/api/laml/2010-04-01/Accounts/' . env('SIGNALWIRE_PROJECTID') . '/Calls');
        // dd($calls);
        $this->targetDate = today();
        $this->startDate = today()->subDays(7);
        $this->numOfCall = ModelsCallhistory::whereBetween('call_date', [$this->startDate, $this->targetDate])->count();
        $this->numOfUniqueCall = ModelsCallhistory::whereBetween('call_date', [$this->startDate, $this->targetDate])
            ->distinct('caller')->count('caller');
    }

    public function render()
    {



        return view('livewire.pages.phone-numbers.call-history', [
            'calls' => ModelsCallhistory::whereBetween('call_date', [$this->startDate, $this->targetDate])
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->where('caller', 'like', "%{$this->search}%")
                ->whereHas('phonenumber.company', function ($query) {
                    $query->where('id', auth()->user()->company->id);  // Filter by the company's ID
                })
                ->paginate(50)
        ]);
    }



    public function sortBy($field)
    {
        $this->sortColumn = $field; // default sort column
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc'; // default sort direction

    }

    // #[Renderless]
    // public function updatedSelectAll($value)
    // {
    //     if ($value) {
    //         $this->selectedItems = collect($this->phoneNumbers)->pluck('id')->all();
    //     } else {
    //         $this->selectedItems = [];
    //     }
    // }

    #[Renderless]
    public function playRecordingEnded()
    {
        $this->readyToPlay = false;
    }

    public function playRecording(string $currentPlayButton, string $recordingUri)
    {
        $this->currentRecording = null;

        $this->readyToPlay = false;

        $this->playRecordingBool = true;

        $this->currentPlayButton = $currentPlayButton;

        $recordings = SignalWire::http($recordingUri);

        if (isset($recordings['recordings']) && count($recordings['recordings']) > 0) {
            $currentRecording = array_pop($recordings['recordings']);
            if (isset($currentRecording['uri'])) {
                $lastJsonPos = strrpos($currentRecording['uri'], '.json');
                $this->currentRecording = 'https://' . env('SIGNALWIRE_SPACE_URL') . substr_replace($currentRecording['uri'], '.mp3', $lastJsonPos);
            }
        }


        $this->readyToPlay = true;

        $this->playRecordingBool = false;

        $this->dispatch('playAudio');

        $this->dispatch('refreshComponent');
    }

    public function generateReport()
    {

        if (!empty($this->selectedItems)) {
            return to_route('call-history-reports', ['calls' =>  json_encode($this->selectedItems)]);
        }

        session(['title' => 'Failed to Generate Report', 'message' => 'Select from the list first!']);
        $this->openToast('failed');


        // $collection = $this->phoneNumbers;
        // $sidArray = $this->selectedItems;


        // $filteredCollection = $collection->filter(function ($item) use ($sidArray) {
        //     return in_array($item['sid'], $sidArray);
        // })->toArray();

        //todo
        // $tempURL = URL::temporarySignedRoute('call-history-reports', now()->addMinutes(5), ['company' => $this->selectedCompany->id, 'calls' =>  json_encode($filteredCollection)]);
        // view()->share('company', $this->selectedCompany->id);



    }
}
