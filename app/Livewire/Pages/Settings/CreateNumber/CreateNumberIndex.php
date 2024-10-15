<?php

namespace App\Livewire\Pages\Settings\CreateNumber;

use Exception;
use App\Integrations\SignalWire;

use App\Models\Phonenumbers;
use App\Models\Phonetracking;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Title;


#[Title('Number Wizard - EZSEO')]
class CreateNumberIndex extends Component
{

    // page 1
    public int $trackingDisplay = 0; // own website - 0 , somwhere else - 1

    // page 2
    public int $trackingUse = 0; // website poll - 0,  calls only -1

    // page 3
    public int $trakcingGoogleAds = 0; // extension - 0, somewhere else - 1

    // page 4
    public int $trackingOption = 0; //all- 0,google- 1,ppc- 2, landing- 3, refer - 4
    public string $swapTarget = "";

    //page 5
    public string $callForwarding = ""; //Number

    //page 6
    public int $numberOfTracking = 4; //
    public string $areaCode = "941";
    public string $selectedNumber;
    public string $poolName = "Website Pool";


    public int $pageCnt = 4;

    //Misc
    public array $availableNumbers = [];
    public $percent = [
        10,
        30,
        35,
        40,
        50,
        60,
        70,
        100
    ];

    public $pages = [
        "Tracking Number Display",
        "Tracking Number Use",
        "Tracking Google Ads",
        "Tracking Options",
        "Call Forwarding",
        "Number Setup",
        // "Number Feature",
        "Activate Tracking Number",
        "Purchase Phone Number and Go back to Dashboard"
    ];



    public function mount()
    {
        $this->searchNumber();
    }

    #[Renderless]
    public function searchNumber(): void
    {
        $this->reset('selectedNumber');

        if (Str::length($this->areaCode) == 3) {
            try {
                $numbers = SignalWire::searchNumber($this->areaCode)['available_phone_numbers'];
            } catch (\Exception $th) {
                throw new Exception('ERROR: ' . $th->getMessage());
            }

            // Slice the array to only get the first 4 items
            $slicedNumbers = array_slice($numbers, 0, 4);

            // Map only the needed data (friendly names)
            $this->availableNumbers = array_map(fn($number) => $number['friendly_name'], $slicedNumbers);
        }
    }


    #[Layout('layouts.wizard')]
    public function render()
    {

        return view('livewire.pages.settings.create-number.create-number');
    }


    public function store()
    {

        $pnumber = Phonenumbers::latest()->first();

        Phonetracking::create([
            'phonenumbers_id' => $pnumber->id,
            'display' => $this->trackingDisplay,
            'use' => $this->trackingUse,
            'googleads' => $this->trakcingGoogleAds,
            'options' => $this->trackingOption,
            'swaptarget' => $this->swapTarget,
            'callforwarding' => $this->callForwarding,
            'numoftracking' => $this->numberOfTracking,
            'areacode' => $this->areaCode,
            'poolname' => $this->poolName
        ]);

        //Buy number from Signalwire
        // $this->purchaseNumber();

        //redirect
        return redirect()->route('dashboard');
    }

    public function purchaseNumber()
    {
        $this->selectedNumber = preg_replace('/[^\d+]/', '', $this->selectedNumber);
        SignalWire::purchasePhoneNumber($this->selectedNumber);
    }

    public function Decrease($decBy)
    {
        if ($this->pageCnt == 0) {
        } else {
            $this->pageCnt -= $decBy;
        }
    }

    public function Increase($incBy)
    {
        if ($this->pageCnt == 7) {
        } else {
            $this->pageCnt += $incBy;
        }
    }
}
