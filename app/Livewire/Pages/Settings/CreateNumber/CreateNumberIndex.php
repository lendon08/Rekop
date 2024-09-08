<?php

namespace App\Livewire\Pages\Settings\CreateNumber;

use App\Integrations\SignalWire;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;

#[Title('Number Wizard - EZSEO')]
class CreateNumberIndex extends Component
{


    public $trackingDisplay = 0; // own website - 0 , somwhere else - 1

    public $trackingUse = 0; // website pooll - 0,  calls only -1

    public $trakcingGoogleAds = 0;

    // $client->sendAsync($request)->wait();





    // all- 0
    // google- 1
    // ppc- 2
    // landing- 3
    // refer - 4
    public $trackingOption = 0;

    public $trackingOptionURL = ""; //Need to do something


    // existing - 0
    // softphone - 1
    public $callForwarding = 0;


    public $areaCode = "941";

    public $availableNumbers = [];
    //---------------------Page Counter---------------------------
    public $pageCnt = 6;

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
        "Number Feature",
        "Activate Tracking Number"
    ];

    public $numberCnt = 1;

    public function mount()
    {
        $numbers = SignalWire::searchNumber("941")['available_phone_numbers'];
        // Slice the array to only get the first 4 items
        $slicedNumbers = array_slice($numbers, 0, 4);

        // Map only the needed data (friendly names)
        $this->availableNumbers = array_map(fn($number) => $number['friendly_name'], $slicedNumbers);
        // dd($this->availableNumbers);
        // Set the count if required
        $this->numberCnt = count($this->availableNumbers);
    }

    public function searchNumber()
    {

        if (Str::length($this->areaCode) == 3) {
            $numbers = SignalWire::searchNumber($this->areaCode)['available_phone_numbers'];

            // Slice the array to only get the first 4 items
            $slicedNumbers = array_slice($numbers, 0, 4);

            // Map only the needed data (friendly names)
            $this->availableNumbers = array_map(fn($number) => $number['friendly_name'], $slicedNumbers);
            // dd($this->availableNumbers);
            // Set the count if required
            $this->numberCnt = count($this->availableNumbers);
        }
    }


    #[Layout('layouts.wizard')]
    public function render()
    {
        return view('livewire.pages.settings.create-number.create-number');
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
