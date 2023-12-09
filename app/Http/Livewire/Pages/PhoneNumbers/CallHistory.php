<?php

namespace App\Http\Livewire\Pages\PhoneNumbers;

use App\Integrations\SignalWire;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;



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

        // Update Forwarding
        // SignalWire::updateForwarding('/api/relay/rest/phone_numbers/a76a4ebc-4f6e-47aa-bd66-21b36ccd6ec7', 
        // "https://riztheseowiz.signalwire.com/api/laml/2010-04-01/Accounts/341c89fe-24f0-4265-8c1f-ba993b277d0c/LamlBins/b39786ed-ab4e-4db1-8ef1-81e19b3a153c");
        
        $sortedUsers = $this->phoneNumbers ?? [];
        $companyNumbers = SignalWire::http('/api/relay/rest/phone_numbers/')['data'];
// dd($companyNumbers);
        if ($this->sortDirection === 'desc') {
            $sortedUsers =  $sortedUsers->sortByDesc($this->sortField);
        } else {
            $sortedUsers =  $sortedUsers->sortBy($this->sortField);
        }

        $sortedUsers =  $sortedUsers->all();

        $perPage = 10; // Display 10 users per page
        $currentPage = $this->page ?: 1;
        $offset = ($currentPage - 1) * $perPage;

        foreach ($sortedUsers as $key => $value) {
            $sortedUsers[$key]['duration'] = $this->beautifyCallDuration($value['duration']);
            $sortedUsers[$key]['date_created'] = $this->beautifyCallDate($value['date_created']);
            $sortedUsers[$key]['direction'] = $this->beautifyCallDirection($value['direction']);

            foreach($companyNumbers as $key2 => $value2){
                if($value2['id'] == $sortedUsers[$key2]['phone_number_sid']){
                    $sortedUsers[$key]['pname']=$value2['name'];
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

        $recordings = SignalWire::http($recordingUri);

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

    public function toTimeFormat($seconds)
    {

        return Carbon\CarbonInterval::seconds($seconds)->cascade()->forHumans();
    }
}
