<?php

namespace App\Http\Livewire\Modules;

use Livewire\Component;

class Form extends Component
{   
    public bool $isOpen = false;

    public bool $isConfirm = false;

    public string $form;

    public string $action;

    public array $data;

    protected $listeners = [
        'showForm' => 'open', 
        'closeForm' => 'close'
    ];

    public function open(string $form, string $action, array $data)
    {       
        $this->isOpen = true;

        $this->form = $form;   

        $this->action = $action;   

        $this->data = $data; 

        $this->isConfirm = ($action == 'destroy') ? true : false;
    }

    public function close()
    {   
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.modules.form');
    }
}
