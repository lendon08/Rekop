<?php

namespace App\Livewire\Codeblockmanager\Pages;


use Livewire\Component;

class Greetings extends Component
{
    public $block;
    public $message = 'This call may be recorded and shared with third-party providers.';
    

    

    public function render()
    {
        return view('livewire.codeblockmanager.pages.greetings');
    }

    public function removeBlock($blockId)
    {
     
    }

    public function chooseMenu($menuType, $blockId)
    {
        
    }
}
