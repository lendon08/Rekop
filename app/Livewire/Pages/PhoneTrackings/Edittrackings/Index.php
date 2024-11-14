<?php

namespace App\Livewire\Pages\PhoneTrackings\Edittrackings;

use App\Models\Phonenumbers;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\Attributes\On;

class Index extends Component
{
    public $id = "";
    public $phone;

    public $numberOptions = true;
    public $insertoptions = true;
    public $advanceoptions = false;


    public function mount(Request $request)
    {
        $this->id = $request->id;
        $this->phone = Phonenumbers::find($this->id);
    }
    public function render()
    {
        $this->phone = Phonenumbers::find($this->id);

        return view('livewire.pages.phone-trackings.edittrackings.index');
    }

    #[On('toggleParent')]
    public function toggle($toggle)
    {

        if (property_exists($this, $toggle)) {
            $this->$toggle = !$this->$toggle;
            switch ($toggle) {
                case 'numberOptions':
                    $this->dispatch('toggleNumberOption', data: $this->$toggle);
                    break;
                case 'insertoptions':
                    $this->dispatch('toggleInsertOption', data: $this->$toggle);
                    break;
                case 'advanceoptions':
                    $this->dispatch('toggleAdvanceOption', data: $this->$toggle);
                    break;
                default:
                    break;
            }
        }
    }
}
