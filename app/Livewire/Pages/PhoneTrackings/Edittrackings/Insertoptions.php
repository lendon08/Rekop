<?php

namespace App\Livewire\Pages\PhoneTrackings\Edittrackings;

use App\Http\Controllers\FileController;
use App\Models\Phonenumbers;
use App\Models\Phonetracking;
use Livewire\Attributes\On;
use Livewire\Component;

class Insertoptions extends Component
{

    public $insertoptions;
    public $id;
    public $phone;

    public $swaptarget;
    public $trackingsource;
    public $trackingoptions;
    public $searchengine;
    public $traffic;
    public $url;
    public $url1;
    public $url2;
    public $url3;
    #[On('toggleInsertOption')]
    public function toggle($data)
    {
        $this->insertoptions = $data;
    }
    public function closeInsert($toggle)
    {
        $this->dispatch('toggleParent', toggle: $toggle);
    }

    public function InsertOptionSave()
    {
        // dd("wtf");

        $this->arrange();

        Phonetracking::where('phonenumber_id', $this->id)->update([
            'tracking_options' => $this->trackingoptions,
            'swaptarget' => $this->swaptarget,
            'URL' => $this->url,
            'search_engine' => $this->searchengine,
            'traffic' => $this->traffic
        ]);
        $file = new FileController();
        $file->createJavaScriptFile();

        $this->closeInsert('insertoptions');
        $this->dispatch('showtoast', 'Insert Options Saved');
    }

    public function arrange()
    {
        $a = $this->trackingoptions;

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
    public function mount($data, $phone, $id)
    {
        $this->id = $id;
        $this->phone = $phone;
        $this->insertoptions = $data;
        $this->trackingoptions = $this->phone->tracking->tracking_options->value;
        $this->swaptarget = $phone->tracking->swaptarget;
        $this->searchengine = $phone->tracking->search_engine;
        $this->url = $this->phone->tracking->URL;
        $a = $this->trackingoptions;
        if ($a == 'Web Referrals') {
            $this->url1 = $this->url;
        } elseif ($a == 'Landing Page') {
            $this->url2 = $this->url;
        } else {
            $this->url3 = $this->url;
        }
    }
    public function render()
    {
        $this->phone = Phonenumbers::find($this->id);
        return view('livewire.pages.phone-trackings.edittrackings.insertoptions');
    }
}
