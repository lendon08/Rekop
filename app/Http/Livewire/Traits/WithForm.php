<?php

namespace App\Http\Livewire\Traits;

trait WithForm
{
    protected function openForm(string $form, string $action = 'create', array $data = [])
    {   
        $this->emitTo('modules.form', 'showForm', $form, $action, $data);
    }

    protected function closeForm()
    {
        $this->emitTo('modules.form', 'closeForm');
    }
}