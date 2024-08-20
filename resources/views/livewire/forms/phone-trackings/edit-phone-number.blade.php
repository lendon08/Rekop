<div>
    <x-organisms.form>
        <div>
            <x-atoms.forms.label for="name">Name</x-atoms.label>
                <x-atoms.forms.textbox type="text" wire:model.live="name" disabled="false" />
                <x-atoms.forms.validation for="form.name" />
        </div>

        <!-- <x-atoms.forms.button type="button" color="success" wire:click.prevent="addSchedule({{$i}})">
            <x-atoms.icons.addschedule />Add Schedule
        </x-atoms.forms.button>

        <x-atoms.forms.button type="button" color="secondary" wire:click.prevent="removeSchedule({{$i}})" disabled>
            <x-atoms.icons.trash />Remove Schedule
        </x-atoms.forms.button> -->


        @foreach($schedules as $key => $schedule)
        <input type="hidden" wire:model.live="schedid.{{$key}}" value="schedid[{{$key}}]">
        <fieldset class="block p-2.5 w-50 text-sm text-gray-900 bg-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
            <legend>
                Business Hours # {{ " ". $key+1}}
            </legend>

            <x-atoms.forms.label for="fwd">Forwarded to
                <x-atoms.forms.textbox type="text" wire:model.live="fwd.{{$key}}" wire:change="formatNumber({{$key}})" wire:keyup="formatNumber({{$key}})" />
                <x-atoms.forms.validation for="form.fwd" />
                </x-atoms.label>
                <div class="grid grid-cols-2 gap-4">
                    <x-atoms.forms.label for="startsched" class="mt-4">Start Time</x-atoms.label>
                        <x-atoms.forms.label for="endsched" class="mt-4">End Time</x-atoms.label>

                            <input type="time" wire:model.live="startsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">


                            <input type="time" wire:model.live="endsched.{{ $key }}" class="block p-2.5 w-50 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
        </fieldset>
        @endforeach

    </x-organisms.form>


</div>