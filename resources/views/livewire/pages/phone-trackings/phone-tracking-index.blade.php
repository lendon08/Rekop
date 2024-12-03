<main class="px-2 space-y-4 overflow-x-hidden">

    <div class="mt-4 flex justify-center items-center ">
        <x-atoms.forms.button variant="top_nav" href="{{ route('phone-settings') }}">
            Tracking
        </x-atoms.forms.button>
        <x-atoms.forms.button variant="top_nav" href="#"  disabled>
            Workflow(not available)
        </x-atoms.forms.button>
        <x-atoms.forms.button variant="top_nav" href="#">
            Integrations
        </x-atoms.forms.button>

    </div>

    @include('livewire.pages.phone-trackings.trackingindex.tracking')
</main>
