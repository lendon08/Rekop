<main class="px-2 space-y-4 mb-14">
    <x-slot:title>
        {{ $phone->name }} | EZSEO
    </x-slot:title>
    {{-- header --}}
    <div
        x-data="{ open: @entangle('showToast') }"
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity- 0 translate-y-4"
        class="fixed top-5 right-5 bg-blue-500 text-white px-4 py-2 rounded shadow-lg"
        style="display: none;"
    >
        <p x-text="$wire.message"></p>
</div>
    <div class="flex px-12 mt-10 w-full text-2xl font-bold sm:px-12 justify-between">
        <div>
            <span class="block">
                <x-atoms.forms.button href="{{route('phone-settings')}}">
                    <x-atoms.icons.back ></x-atoms.icons.back>
                </x-atoms.forms.button>

                <span>{{ $phone->name }} ( {{ $phone->number }} )</span>
            </span>

        </div>
        <x-atoms.forms.button wire:click.prevent="deactivate" class="border-red-600 border-2 text-red-500">
            Deactive Number
        </x-atoms.forms.button>
    </div>



    <div class="bg-white items-center justify-between border-b border-gray-200 rounded-lg mx-10">
        <div class="flex items-center justify-between m-4">
            <div class="pt-4 text-xl">Number Options</div>
            <x-atoms.forms.button wire:click.prevent="toggle('numberOptions')">
                <x-atoms.icons.edit ></x-atoms.icons.edit>
            </x-atoms.forms.button>
        </div>
        <hr class="h-px bg-gray-200 border-0 ">
        <div>
            @livewire('pages.phone-trackings.edittrackings.numberoptions', ['data' => $numberOptions, 'phone'=> $phone, 'id' => $id ])
        </div>
    </div>

    <div class="bg-white items-center justify-between border-b border-gray-200 rounded-lg mx-10">
        <div class="flex items-center justify-between my-4 mx-4">
            <div class="pt-4 text-xl">Number Insertion Options</div>
            <x-atoms.forms.button wire:click.prevent="toggle('insertoptions')">
                <x-atoms.icons.edit></x-atoms.icons.edit>
            </x-atoms.forms.button>
        </div>
        <hr class="h-px bg-gray-200 border-0 ">
        <div >
            @livewire('pages.phone-trackings.edittrackings.insertoptions', ['data' => $insertoptions, 'phone'=> $phone, 'id' => $id ])
        </div>
    </div>

    <div class="bg-white items-center justify-between border-b border-gray-200 rounded-lg mx-10">
        <div class="flex items-center justify-between my-4 mx-4">
            <div class="pt-4 text-xl">Advanced Options</div>
            <x-atoms.forms.button wire:click.prevent="toggle('advanceoptions')">
                <x-atoms.icons.edit></x-atoms.icons.edit>
            </x-atoms.forms.button>
        </div>
        <hr class="h-px bg-gray-200 border-0 ">
        <div>
            @livewire('pages.phone-trackings.edittrackings.advanceoptions', ['data' => $advanceoptions, 'phone'=> $phone, 'id' => $id ])

        </div>
    </div>
</main>

@script
    <script>
        $wire.on('toast-hidden', () => {
            setTimeout(() => {
                $wire.showToast = false;
            }, 3000);
        });
    </script>
@endscript
