<?php

namespace App\Livewire\Pages\Settings\CreateNumber;

use Livewire\Component;
use Livewire\Attributes\Layout;

class CreateNumberIndex extends Component
{
    public $pageCnt = 6;

    public $toTrack=0; // 0-All, 1-Calls Only
 
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
    public function mount()
    {

    }

    


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
