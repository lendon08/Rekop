<?php

namespace App\Livewire\Pages;

use App\Integrations\SignalWire;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Illuminate\Http\Request;

#[Title('EZSEO')]
class Dashboard extends Component
{
    //TODO SET the correct timezone
    public $week;

    public function mount()
    {
        // Get date now until last week
        $now = Carbon::now();
        $prev = Carbon::now()->subDays(7);
        $this->week = $now->format('M d') . " - " .  $prev->format('M d');
    }

    public function checkCallStatus($number)
    {

        $isInCall = SignalWire::isNumberInCall($number);

        if (is_null($isInCall)) {
            return response()->json(['error' => 'Failed to check call status'], 500);
        }

        return response()->json([
            'number' => $number,
            'in_call' => $isInCall,
        ]);
    }
    public function render()
    {
        // dd($this->checkCallStatus("+1 (941) 324-3994"));
        return view('livewire.pages.dashboard');
    }
}
