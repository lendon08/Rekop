<?php

namespace App\Livewire\Pages\Settings\CreateNumber;

use App\Http\Controllers\FileController;
use Exception;
use App\Integrations\SignalWire;
use App\Models\Phonenumbers;
use App\Models\Phonetracking;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\PseudoTypes\False_;

#[Title('Number Wizard - EZSEO')]
class CreateNumberIndex extends Component
{

    // page 1
    public int $trackingDisplay = 0; // own website - 0 , somwhere else - 1

    // page 2
    public int $trackingUse = 0; // website poll - 0,  calls only -1

    // page 3
    public int $trakcingGoogleAds = 0; // extension - 0, somewhere else - 1

    //page 5
    public string $callForwarding = ""; //Number

    public string $poolName = "Website Pool";

    public string $selectedNumber;

    public int $pageCnt = 0;

    //Misc

    public $percent = [10, 30, 35, 40, 50, 60, 70, 100];

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

    public $searchengine;
    public $traffic;
    public $url;
    public $url1;
    public $url2;
    public $url3;

    public string $areaCode = "539";
    public array $availableNumbers = [];
    public int $numberOfTracking = 4;

    // page 4
    public $trackingOption = "All Visitors";
    public string $tracking_search = "";
    public string $tracking_traffic = "";
    public string $swapTarget = "";
    public string $phonename  = "";
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
    public function mount()
    {

        $this->traffic = \App\Enums\TrackingTraffic::cases()[0]->value;
        $this->searchengine = \App\Enums\TrackingSearchEngine::cases()[0]->value;
        $this->searchNumber();
    }

    #[Layout('layouts.wizard')]
    public function render()
    {
        return view('livewire.pages.settings.create-number.create-number');
    }


    public function store()
    {

        $this->arrange();
        // Buy number from Signalwire
        $phonenumber =  $this->purchaseNumber();

        //Update all phone numbers information base data : (Current: Name)
        $pn = SignalWire::updatePhonenumber($phonenumber['id'], $this->phonename);



        //Save phonenumber to database
        Phonenumbers::create([
            'id' => $pn['id'],
            'name' => $pn['name'],
            'number' => $pn['number'],
            'company_id' => auth()->user()->company_id
        ]);

        //Save to settings to phonetracking
        Phonetracking::create([
            'phonenumber_id' => $pn['id'],
            'display' => $this->trackingDisplay,
            'useon' => $this->trackingUse,
            'googleads' => $this->trakcingGoogleAds,
            'tracking_options' => $this->trackingOption,
            'utm_source' => 'offline',
            'utm_medium' => 'direct',
            'utm_campaign' => $this->phonename,
            'URL' => $this->url,
            'traffic' => $this->traffic,
            'search_engine' => $this->searchengine,
            'swaptarget' => $this->swapTarget,
            'whispermsg' => '',
            'recordingflag' => true,
            'textmsg' => false,
            'callgreeting' => 'This call will be recorded for quality assurance.',
            'campaignname' => $this->phonename,
            'autoreply' => false,
            'callforwarding' => $this->callForwarding,
            'numoftracking' => $this->numberOfTracking,
            'areacode' => $this->areaCode,
            'poolname' => $this->phonename
        ]);
        $file = new FileController();
        $file->createJavaScriptFile();
        //redirect
        return redirect()->route('phone-settings');
    }
    public function purchaseNumber()
    {
        $this->selectedNumber = preg_replace('/[^\d+]/', '', $this->selectedNumber);
        return SignalWire::purchasePhoneNumber($this->selectedNumber);
    }

    public function Decrease($decBy)
    {
        if ($this->pageCnt == 0) {
        } else {
            $this->pageCnt -= $decBy;
        }
        // $this->dispatch('toggleNumberOption', data: $this->numberOptions);
        $this->dispatch('pageChange', pageCnt: $this->pageCnt);
    }

    public function Increase($incBy)
    {
        if ($this->pageCnt == 7) {
        } else {
            $this->pageCnt += $incBy;
        }
        $this->dispatch('pageChange', pageCnt: $this->pageCnt);
    }
    public function arrange()
    {
        $a = $this->trackingOption;

        if ($a == 'Search') {
            $this->url = "";
            if ($this->searchengine == "" || $this->traffic == "") {
                $this->searchengine = "Google";
                $this->traffic = "Paid";
            }
        } elseif ($a == 'All Visitors' || $a == 'Direct' || $a == 'Other') {
            $this->url = "";
            $this->searchengine = "";
            $this->traffic = "";
        } else {

            if ($a == 'Web Referrals') {
                $this->url = $this->url1;
            } elseif ($a == 'Landing Page') {
                $this->url = $this->url2;
            } else {
                $this->url = $this->url3;
            }
            $this->url1 = "";
            $this->url2 = "";
            $this->url3 = "";
            $this->searchengine = "";
            $this->traffic = "";
        }
    }
}
