<?php

namespace App\Livewire\Pages\PhoneNumbers;

use App\Livewire\Traits\WithToast;
use App\Integrations\SignalWire;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Title;
use Livewire\Attributes\Renderless;

#[Title('Call History')]
class CallHistory extends Component
{

    public $class = "inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto";

    // TODO get all recording values to another controller


    use WithPagination, WithToast;

    public $selectAll = false;

    public $selectedItems = [];

    public $phoneNumbers = []; // Your custom array of users

    public $sortField = 'name'; // Default sorting field

    public $sortDirection = 'asc'; // Default sorting direction

    public bool $readyToDisplayCalls = false;

    public bool $readyToPlay = false;

    public bool $playRecordingBool = false;

    public ?string $currentRecording = null;

    public ?string $currentPlayButton = null;

    public Company $selectedCompany;

    public int $numOfCall = 0;

    public int $numOfUniqueCall = 0;

    public int $page = 0;

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'playRecordingEnded' => 'playRecordingEnded'
    ];

    //1. Make use of the Signalwire Natural Pagination or
    // store it in database
    //2.
    public function mount()
    {
        $calls = SignalWire::http('/api/laml/2010-04-01/Accounts/' . env('SIGNALWIRE_PROJECTID') . '/Calls??Status=completed');

        $this->numOfCall = count($calls['calls'] ?? []);


        $uniqueCalls = [];
        foreach ($calls['calls'] as $call) {
            if (isset($call['to'])) {
                $uniqueCalls[] = $call['to'];
            }
        }

        $this->numOfUniqueCall = count(array_unique($uniqueCalls) ?? []);

        $this->phoneNumbers = collect($calls['calls'] ?? []);
    }

    public function render()
    {

        $sortedUsers = (object) $this->phoneNumbers ?? [];
        $companyNumbers = SignalWire::http('/api/relay/rest/phone_numbers/')['data'];

        if ($this->sortDirection === 'desc') {
            $sortedUsers =  $sortedUsers->sortByDesc($this->sortField);
        } else {
            $sortedUsers =  $sortedUsers->sortBy($this->sortField);
        }

        $sortedUsers =  $sortedUsers->all();

        $perPage = 10; // Display 10 users per page
        $currentPage = $this->page ?: 1;
        $offset = ($currentPage - 1) * $perPage;

        //TODO transfer to another controller or helper 
        foreach ($sortedUsers as $key => $value) {
            $sortedUsers[$key]['duration'] = $this->beautifyCallDuration($value['duration']);
            $sortedUsers[$key]['date_created'] = $this->beautifyCallDate($value['date_created']);
            $sortedUsers[$key]['direction'] = $this->beautifyCallDirection($value['direction']);

            foreach ($companyNumbers as $key2 => $value2) {
                if ($value2['id'] == $sortedUsers[$key2]['phone_number_sid']) {
                    $sortedUsers[$key]['pname'] = $value2['name'];
                }
            }
        }

        //Laravel Pagination -> Signalwire
        $paginatedUsers = new LengthAwarePaginator(
            array_slice($sortedUsers, $offset, $perPage, true),
            count($sortedUsers),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );


        return view('livewire.pages.phone-numbers.call-history', [
            'calls' => $paginatedUsers
        ]);
    }

    function beautifyCallDate($date)
    {
        $date = substr($date, 5, 20);
        $newdate = substr($date, 3, 3) . ' ' . substr($date, 0, 2) . ' ' . date("g:i A", strtotime(substr($date, 12, 8)));
        return $newdate;
    }
    function beautifyCallDuration($duration)
    {
        return gmdate("H:i:s", $duration);
    }
    function beautifyCallDirection($direction)
    {
        return ucfirst(str_replace("-dial", "", $direction));
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

    #[Renderless]
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = collect($this->phoneNumbers)->pluck('sid')->all();
        } else {
            $this->selectedItems = [];
        }
    }

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
