<div class="mb-8">
    <div class="p-4 border rounded shadow-sm bg-white w-full text-gray-800 text-left" id="block-{{ $block['id'] }}">
        <div class="flex justify-between items-center">
            <h4 class="font-bold text-lg">Greetings</h4>
            <button class="text-red-500 hover:underline" wire:click="removeBlock({{ $block['id'] }})">x</button>
        </div>
        <div class="text-gray-500 text-sm">Play a message to the caller. Frequently used to notify the caller about call recording.</div>
        <hr class="h-px my-4 bg-gray-200 border-0">
        <div class="space-y-2 text-sm">
            <p>Read the following text to the caller with a robot-like voice:</p>
            <textarea class="w-full border border-gray-300 p-2 resize-none text-sm" placeholder="Type your message here..." wire:model="message">{{ $message }}</textarea>
            <button class="flex items-center text-blue-600">
                <x-atoms.icons.play class="mr-2"></x-atoms.icons.play>
                Preview Message
            </button>
        </div>
    </div>
    <button class="my-4 px-4 py-2 text-blue-500 rounded hover:text-white hover:bg-blue-600" wire:click="chooseMenu('OPMENU', {{ $block['id'] + 1 }})">
        + Insert Step Here
    </button>
</div>
