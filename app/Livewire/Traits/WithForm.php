<?php

namespace App\Livewire\Traits;

trait WithForm
{
    protected function openForm(string $form, string $action = 'create', array $data = [])
    {   
        $this->dispatch('showForm', $form, $action, $data)->to('modules.form');
    }

    protected function closeForm()
    {
        $this->dispatch('closeForm')->to('modules.form');
    }
}