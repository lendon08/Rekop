<?php

namespace App\Livewire\Modules;

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

  
    public function open(string $mode)
    {   
        $this->mode = $mode;
        
        $this->showToast = true;

        $this->title = session('title') ?? $this->defaultMessage['title'];
        
        $this->message = session('message') ?? $this->defaultMessage['message'];

        session()->forget('title', 'message');
        
        $this->dispatch('closeToast');
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
