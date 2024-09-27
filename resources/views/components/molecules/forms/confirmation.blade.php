<x-atoms.icons.toast-confirm />
<h2 class="mb-1 text-lg font-semibold text">Are you sure?</h2>
<h3 class="mb-1 text-lg text">You won't be able to revert this!</h3>
<div class="mt-5 bottom-0 left-0 flex pb-4 space-x-4">
    <x-atoms.forms.button variant="success" type="submit" wire:click="confirm">
        <x-atoms.icons.plus /> Yes I'm sure
    </x-atoms.forms.button>
    <x-atoms.forms.button type="button" variant="danger" wire:click="$dispatchTo('modules.drawer', 'closeDrawer')">
        <x-atoms.icons.cancel /> Cancel
    </x-atoms.forms.button>
</div>