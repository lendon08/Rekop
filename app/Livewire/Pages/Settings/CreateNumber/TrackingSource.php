<?php

namespace App\Livewire\Pages\Settings\CreateNumber;

use Livewire\Attributes\On;
use Livewire\Component;

class TrackingSource extends Component
{
    public $pageCnt;

    // page 4
    public int $trackingOption = 0; //all- 0,Search- 1,web referral- 2, landing page- 3, landing param-4, direct - 5
    public string $tracking_search = "";
    public string $tracking_traffic = "";
    public string $swapTarget = "";

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
        return view('livewire.pages.settings.create-number.tracking-source');
    }
}
