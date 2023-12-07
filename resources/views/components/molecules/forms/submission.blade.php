<div class="mt-5 bottom-0 left-0 flex pb-4 space-x-4">
    {{ $slot }}
    <x-atoms.forms.button type="button" color="danger" wire:click.defer="$emitTo('modules.drawer', 'closeDrawer')">
        <x-atoms.icons.cancel /> Cancel
    </x-atoms.forms.button>
</div>