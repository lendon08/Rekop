<?php

namespace App\Livewire\Pages;


use App\Models\Callhistory;
use App\Models\Phonenumbers;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('EZSEO')]
class Dashboard extends Component
{

    public $week;

    // TW = This Week
    public $TWuniqueCalls = 0;
    public $TWtotalCalls = 0;
    private $TWstart;
    private $TWend;

    // LW = Last week
    public $LWuniqueCalls = 0;
    public $LWtotalCalls = 0;
    private $LWstart;
    private $LWend;

    public $TotalCallsPercentage;
    public $UniqueCallsPercentage;

    public $unansweredCall;
    public $answeredCall;
    public $recievedCategory;
    public $TWcall = [];
    public $LWcall = [];

    public $categories;
    public $recentCalls;
    public $callData;
    public function mount()
    {


        $totalCount = Callhistory::count();

        $this->callData = Callhistory::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->map(function ($item) use ($totalCount) {
                $item->percentage = $totalCount > 0 ? number_format(($item->total / $totalCount) * 100, 2) : 0;
                return $item;
            });



        //Setup for this Week
        $this->TWstart = today()->subMinute();
        $this->TWend = today()->subWeek();

        $this->week = $this->TWend->format('M d')  . " - " . $this->TWstart->format('M d');
        $this->TWtotalCalls = Callhistory::whereBetween('call_date', [$this->TWend, $this->TWstart])->count();
        $this->TWuniqueCalls = Callhistory::whereBetween('call_date', [$this->TWend, $this->TWstart])
            ->distinct('caller')->count('caller');
        $TWcalls = Callhistory::select('phonenumber_id', DB::raw('count(*) as total'))
            ->whereBetween('call_date', [$this->TWend, $this->TWstart])
            ->groupBy('phonenumber_id')
            ->get();

        // Setup for last Week
        $this->LWstart = today()->subWeek();
        $this->LWend = today()->subWeek(2);
        $this->LWtotalCalls = Callhistory::whereBetween('call_date', [$this->LWend, $this->LWstart])->count();
        $this->LWuniqueCalls = Callhistory::whereBetween('call_date', [$this->LWend, $this->LWstart])
            ->distinct('caller')->count('caller');
        $LWcalls = Callhistory::select('phonenumber_id', DB::raw('count(*) as total'))
            ->whereBetween('call_date', [$this->LWend, $this->LWstart])
            ->groupBy('phonenumber_id')
            ->get();

        $unansweredCalls = Callhistory::where('status', 'no-answer')
            ->whereDate('call_date', '2024-06-04') //Use only to show that there is no-answerword
            // ->whereDate('call_date', today()) // NOTE: use this
            ->select(DB::raw('HOUR(call_date) as hour'), DB::raw('COUNT(*) as total'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();
        // dd($unansweredCalls);
        $answeredCalls = Callhistory::where('status', 'completed')
            ->whereDate('call_date', today())
            ->select(DB::raw('HOUR(call_date) as hour'), DB::raw('COUNT(*) as total'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $this->recentCalls = Callhistory::
            // whereDate('call_date', today()) //NOTE: use this
            whereBetween('call_date', [$this->TWend, $this->TWstart]) //Just to show it works. I'll get this week values
            ->limit(5)
            ->get();

        $phoneNumbers = Phonenumbers::getName();

        // Loop through each category and check values in both $TWcall and $LWcall
        foreach ($phoneNumbers as $index => $category) {
            $twValue = $TWcalls[$index]->total ?? 0;
            $lwValue = $LWcalls[$index]->total ?? 0;
            if ($twValue > 0 ||  $lwValue > 0) {
                $this->TWcall[] = $twValue;
                $this->LWcall[] = $lwValue;
                $this->categories[] = $category;
            }
        }
        $flag = false;
        for ($i = 0; $i < 24; $i++) {
            // Find the entry for the current hour in answered and unanswered calls
            $answered = $answeredCalls->firstWhere('hour', $i);
            $unanswered = $unansweredCalls->firstWhere('hour', $i);
            if ($answered || $unanswered || $flag) {
                $flag = true;
                // If there’s no entry for the current hour, default to 0
                $this->answeredCall[] = $answered->total ?? 0;
                $this->unansweredCall[] = $unanswered->total ?? 0;
                // Add the current hour to the recievedCategory array
                $this->recievedCategory[] = ($i % 12 === 0 ? 12 : $i % 12) . ($i < 12 ? ' AM' : ' PM');
            }
        }
        // Loop thru all Phone numbers then each PN is qouted '' then is separated with ,
        $this->categories = collect($this->categories)->map(fn($item) => "'$item'")->join(', ');
        $this->TWcall = collect($this->TWcall)->map(fn($item) => "$item")->join(', ');
        $this->LWcall = collect($this->LWcall)->map(fn($item) => "$item")->join(', ');

        $this->unansweredCall = collect($this->unansweredCall)->map(fn($item) => "$item")->join(', ');
        $this->answeredCall = collect($this->answeredCall)->map(fn($item) => "$item")->join(', ');
        $this->recievedCategory = collect($this->recievedCategory)->map(fn($item) => "'$item'")->join(', ');

        // Total Call and Unique Percentage increase or decrease
        $this->TotalCallsPercentage = $this->LWtotalCalls == 0 ? 100 : (($this->TWtotalCalls - $this->LWtotalCalls) / $this->LWtotalCalls) * 100;
        $this->UniqueCallsPercentage = $this->LWuniqueCalls == 0 ? 100 : (($this->TWuniqueCalls - $this->LWuniqueCalls) / $this->LWuniqueCalls) * 100;
    }

    public function render()
    {

        return view('livewire.pages.dashboard');
    }
}
