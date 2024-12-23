<?php

namespace App\Livewire;

use Livewire\Component;

class CodeBlockManager extends Component
{
    public $codeBlocks = [];
    public $blockType = '';

    public $days = ['Any Day', 'Weekdays', 'Weekends', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    public $times = ['All Day', 'Between'];
    public $seconds = [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55];
    public function chooseMenu($type, $id)
    {

        // Insert the new block
        $newBlock = [
            'id' => $id,
            'type' => $type,

        ];
        // Insert the new block at the correct position and increment IDs
        foreach ($this->codeBlocks as $index => $block) {
            if ($block['id'] >= $id) {
                array_splice($this->codeBlocks, $index, 0, [$newBlock]); // Insert new block
                // Increment IDs of succeeding blocks
                for ($i = $index + 1; $i < count($this->codeBlocks); $i++) {
                    $this->codeBlocks[$i]['id']++;
                }
                return;
            }
        }
        $this->codeBlocks[] = $newBlock;
    }

    public function removeBlock($id)
    {
        $this->codeBlocks = array_filter($this->codeBlocks, fn($block) => $block['id'] !== $id);
    }

    public function addBlock($id, $type)
    {
        // Remove any existing block with the same ID
        foreach ($this->codeBlocks as $index => $block) {
            if ($block['id'] === $id) {
                array_splice($this->codeBlocks, $index, 1); // Remove the block
                break; // Exit the loop as we only need to delete the first matching ID
            }
        }

        // Insert the new block
        $newBlock = [
            'id' => $id,
            'type' => $type,

        ];

        // Insert the new block at the correct position and increment IDs
        foreach ($this->codeBlocks as $index => $block) {
            if ($block['id'] >= $id) {
                array_splice($this->codeBlocks, $index, 0, [$newBlock]); // Insert new block
                // Increment IDs of succeeding blocks
                for ($i = $index + 1; $i < count($this->codeBlocks); $i++) {
                    $this->codeBlocks[$i]['id']++;
                }
                return;
            }
        }

        // If the ID is larger than all existing IDs, append the new block
        $this->codeBlocks[] = $newBlock;
    }



    public function render()
    {
        return view('livewire.code-block-manager');
    }
}
