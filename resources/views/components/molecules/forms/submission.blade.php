<div class="mt-5 bottom-0 left-0 flex pb-4 space-x-4">
    {{ $slot }}
    <x-atoms.forms.button type="button" variant="danger" wire:click="$dispatchTo('modules.drawer', 'closeDrawer')">
        <x-atoms.icons.cancel /> Cancel
    </x-atoms.forms.button>
</div>