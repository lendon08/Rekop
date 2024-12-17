    <div class="mt-4 flex justify-center items-center ">


        <x-atoms.forms.button variant="top_nav" href="{{ route('phone-settings') }}" :active="request()->is('phone-settings')">
            Tracking
        </x-atoms.forms.button>
        {{-- <x-atoms.forms.button variant="top_nav" href="#"  disabled>
            Workflow(not available)
        </x-atoms.forms.button> --}}
        <x-atoms.forms.button variant="top_nav" href="{{ route('settings-integration')}}" :active="request()->is('settings/integration')">
            Integrations
        </x-atoms.forms.button>

    </div>
