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
    public $advanceoptions = true;
    public $showToast = false;
    public $message = '';

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

    public function deactivate()
    {

        $pn = Phonenumbers::find($this->id);
        $pn->delete();
        return redirect()->route('phone-settings');
    }


    #[On('showtoast')]
    public function showToast($message)
    {
        $this->message = $message;
        $this->showToast = true;

        $this->dispatch('toast-hidden');
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
