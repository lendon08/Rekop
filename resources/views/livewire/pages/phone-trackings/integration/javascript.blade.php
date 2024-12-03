<main class="px-2 space-y-4 overflow-x-hidden">

    <div class="mt-4 flex justify-center items-center ">
        <x-atoms.forms.button variant="top_nav" wire:click.prevent='showToDisplay(0)'>
            Tracking
        </x-atoms.forms.button>
        <x-atoms.forms.button variant="top_nav" wire:click.prevent='showToDisplay(1)' disabled>
            Workflow(not available)
        </x-atoms.forms.button>
        <x-atoms.forms.button variant="top_nav" wire:click.prevent='showToDisplay(2)'>
            Integrations
        </x-atoms.forms.button>

    </div>


</main>
