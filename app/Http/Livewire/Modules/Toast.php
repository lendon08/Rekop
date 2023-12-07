<?php

namespace App\Http\Livewire\Modules;

use Livewire\Component;

class Toast extends Component
{   
    public string $mode;

    public string $title;

    public string $message;

    public bool $showToast = false;

    public array $defaultMessage = [
        'title' => 'Good job!',
        'message' => 'The action has been successfully executed.',
    ];

    protected $listeners = [
        'showToast' => 'open', 
        'closeToast' => 'close',
    ];

    public function open(string $mode, array $options)
    {   
        $this->mode = $mode;

        $this->showToast = true;

        $this->title = $options['title'] ?? $this->defaultMessage['title'];

        $this->message = $options['message'] ?? $this->defaultMessage['message'];

        $this->dispatchBrowserEvent('closeToast');
    }

    public function close()
    {   
        $this->showToast = false;
    }

    public function render()
    {
        return view('livewire.modules.toast');
    }
}
