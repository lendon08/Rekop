<main class="px-2 space-y-4 mb-14">
    <x-slot:title>
        {{ $phone->name }} | EZSEO
    </x-slot:title>
    {{-- header --}}
    <div class="flex px-12 mt-10 w-full text-2xl font-bold sm:px-12 justify-between">
        {{ $phone->name }} ( {{ $phone->number }} )
        <x-atoms.forms.button class="border-red-600 border-2 text-red-500">
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
