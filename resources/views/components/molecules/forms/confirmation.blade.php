<x-atoms.icons.toast-confirm />
<h2 class="mb-1 text-lg font-semibold text-dark-500 dark:text-white">Are you sure?</h2>
<h3 class="mb-1 text-lg text-dark-500 dark:text-white">You won't be able to revert this!</h3>
<div class="mt-5 bottom-0 left-0 flex pb-4 space-x-4">
    <x-atoms.forms.button color="success" type="submit" wire:click.defer="confirm">
        <x-atoms.icons.plus /> Yes I'm sure
    </x-atoms.forms.button>
    <x-atoms.forms.button type="button" color="danger" wire:click.defer="$emitTo('modules.drawer', 'closeDrawer')">
        <x-atoms.icons.cancel /> Cancel
    </x-atoms.forms.button>
</div>