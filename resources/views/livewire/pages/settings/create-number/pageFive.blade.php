<div class="{{ $pageCnt == 5 ? '' : 'hidden' }} text-left space-y-4">
    <div class="space-y-4">
        <p class="text-xl sm:text-xl">Call Forwarding</p>
        <hr class="h-px my-8 bg-gray-200 border-0">
        <p class="text-lg sm:text-lg">Where do you want to route these calls?</p>
    </div>

    <div class="space-y-4 pb-4">
        <div class="flex space-x-2">
            {{-- <div class="flex items-center h-5">
                <input wire:model="callForwarding" aria-describedby="existing-phone" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div> --}}
            <div class="text-base">
                <label for="helper-radio" class="font-medium text-gray-900">An existing phone number</label>
                <p id="existing-phone" class="text-xs font-normal text-gray-500 mb-2">Enter an existing phone number where we should forward your calls.</p>
                <input x-mask="(999)999-9999" placeholder="(123)456-7890" type="text" wire:model.live="callForwarding">
            </div>
        </div>
        {{-- <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model="callForwarding" aria-describedby="softphone" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-base">
                <label for="softphone" class="font-medium text-gray-900">Lead Center's softphone</label>
            </div>
        </div> --}}
    </div>
</div>