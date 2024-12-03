<?php

namespace App\Livewire\Pages\Settings\CreateNumber;

use Livewire\Component;
use Livewire\Attributes\On;

class NumberSetup extends Component
{
    public int $pageCnt;
    public int $numberOfTracking = 4; //



    #[On('pageChange')]
    public function pageChange($pageCnt)
    {
        $this->pageCnt = $pageCnt;
    }
    public function mount($pageCnt)
    {
        $this->pageCnt = $pageCnt;
    }
    public function render()
    {
        return view('livewire.pages.settings.create-number.number-setup');
    }
}
