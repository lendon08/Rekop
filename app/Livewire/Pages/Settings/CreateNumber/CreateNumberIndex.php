<?php

namespace App\Livewire\Pages\Settings\CreateNumber;

use Livewire\Component;
use Livewire\Attributes\Layout;


class CreateNumberIndex extends Component
{
    public $pageCnt = 5;

    public $toTrack=0; // 0-All, 1-Calls Only

    // all- 0
    // google- 1
    // ppc- 2
    // landing- 3
    // refer - 4
    public $trackingOption=0;

    public $trackingOptionURL=""; //Need to do something


    // existing - 0
    // softphone - 1
    public $callForwarding=0;

    public $percent=[
        10,
        10,
        30,
        35,
        40,
        50,
        60,
        70,
        100
    ];
    

    


    #[Layout('layouts.wizard')]
    public function render()
    {
        return view('livewire.pages.settings.create-number.create-number');
    }

    public function Decrease($decBy)
    {
        if($this->pageCnt == 0){

        }else{
            $this->pageCnt -= $decBy;
        }
        
    }
    public function Increase($incBy)
    {
        if($this->pageCnt == 7){

        }else{
            $this->pageCnt += $incBy;
        }
        
    }
}
