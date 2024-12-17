<main class="space-y-4">

    <div class="bg-white flex p-4">


        <div class="flex w-1/2 justify-between mx-auto">
            <div>
                Template
                <input type="text" wire:model="label">
            </div>
            <div>
                <x-atoms.forms.button href="{{route('phone-settings')}}">Cancel</x-atoms.forms.button>
                <x-atoms.forms.button variant="primary">Save</x-atoms.forms.button>
            </div>
        </div>
    </div>

    <div class="flex w-1/2 justify-center mx-auto">
        <div class="flex flex-col text-center ">
            <div class="font-semibold text-lg">Start Call Flow</div>
            <div class="text-gray-600 text-sm">Build a new call flow below.</div>
            <hr class="h-px my-4 bg-gray-700 border-0">
            <div>
                {{-- create a toggle button using checkbox --}}
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Record inbound calls</span>
                </label>
                <span data-popover-target="popover-legal-note" data-popover-placement="right" class="text-blue-700 hover:text-blue-800 text-sm cursor-pointer">Legal Note</span>
            </div>

            <div data-popover id="popover-legal-note" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 max-h-[300px] overflow-y-auto">
                <div class="px-3">
                    <p>Some jurisdictions require both parties to consent to any recorded conversation. To assist in the compliance of these laws, you can enable a greeting to inform the caller that the call may be recorded. Your default greeting should disclose (1) that you are using CallRail to provide recording/transcription services and (2) disclose all purposes of the collection.</p>
                </div>
                <div data-popper-arrow></div>
                <x-atoms.forms.button class='border'>   </x-atoms.forms.button>
            </div>


        </div>


    </div>

</main>
