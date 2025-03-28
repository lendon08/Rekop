@props([
'performAction' => 'create',
])

@php
$isConfirm = ($performAction == 'destroy') ? true : false;
@endphp

<form wire:submit="{{ $performAction }}" {{ $attributes->merge(['class' => 'space-y-4']) }}>

    @if($isConfirm)
        <x-atoms.icons.toast-confirm />
        <h2 class="mb-1 text-lg font-semibold text-dark-500">Are you sure?</h2>
        <h3 class="mb-1 text-lg text-dark-500">You won't be able to revert this!</h3>
    @else
    {{ $slot }}
    @endif
    <div class="mt-5 pb-4 space-x-4 sticky bottom-0 right-0">
        <x-atoms.forms.button variant="success" type="submit">
            <x-atoms.icons.edit /> @if($isConfirm) Yes I'm sure @else Submit @endif
        </x-atoms.forms.button>
        <x-atoms.forms.button type="button" variant="danger" wire:click="$dispatchTo('modules.form', 'closeForm')" >
            <x-atoms.icons.cancel /> Cancel
        </x-atoms.forms.button>
    </div>

</form>