<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
//    TODO SET the correct timezone
    public $week;
    
    public function mount()
    {
        // Get date now until last week
        $now = Carbon::now();
        $prev = Carbon::now()->subDays(7); 
        $this->week = $now->format('M d') ." - ".  $prev->format('M d');

    }
    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
