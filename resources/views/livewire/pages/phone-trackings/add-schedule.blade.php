
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="w-full mb-1">
        <form wire:submit="create()" class="space-y-4">
            
                <div class="mt-6 mb-6">
                    <div class="flex">
                        <a href="{{ route('phone-settings') }}" class="text-center">
                            <x-atoms.icons.back></x-atoms.icons.back>
                        </a>
                        <x-atoms.forms.label for="name">Name</x-atoms.label>
                    </div>
                    <x-atoms.forms.textbox type="text" wire:model.live="pnname" disabled />
                    
                    <x-atoms.forms.validation for="form.name" />
                </div>
                
            
            <div class='mb-6'>
                <x-atoms.forms.button type="button" variant="primary" wire:click.prevent="addSchedule({{$i}})">
                    <x-atoms.icons.addschedule />Add Schedule
                </x-atoms.forms.button>

                <x-atoms.forms.button type="button" variant="secondary" wire:click.prevent="removeSchedule({{$i}})">
                    <x-atoms.icons.trash />Remove Schedule
                </x-atoms.forms.button>
            </div>

            @foreach($schedules as $key => $schedule)
            <fieldset class="block p-2.5 w-full text-sm text-gray-900 bg-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                <legend class="text-2xl">
                    Business Hours # {{ " ". $key + $sets + 1}}
                </legend>
                <x-atoms.forms.label class="text-xl font-bold" for="fwd">Forwarded to
                    <x-atoms.forms.textbox type="text" wire:model.live="fwd.{{$key}}" x-mask="(999)999-9999" />
                    <x-atoms.forms.validation for="form.fwd" />
                    </x-atoms.label>
                    <x-atoms.forms.label class="text-xl font-bold mt-10" for="schedule">Schedule
                        <div class="grid grid-cols-7">
                            <div class="w-full p-4 text-center box-border">
                                <input type="time" wire:model.live="monstartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                                <input type="time" wire:model.live="monendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                <x-atoms.forms.label class='mt-2 text-xl' for="monday.{{$key}}">Monday</x-atoms.label>
                            </div>
                            <div class="w-full p-4 text-center">
                                <input type="time" wire:model.live="tuestartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                                <input type="time" wire:model.live="tueendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                <x-atoms.forms.label class='mt-2 text-xl' for="tuesday.{{$key}}">Tuesday</x-atoms.label>
                            </div>
                            <div class="w-full p-4 text-center">
                                <input type="time" wire:model.live="wedstartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                                <input type="time" wire:model.live="wedendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                <x-atoms.forms.label class='mt-2 text-xl' for="wednesday.{{$key}}">Wednesday</x-atoms.label>
                            </div>
                            <div class="w-full p-4 text-center">
                                <input type="time" wire:model.live="thustartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                                <input type="time" wire:model.live="thuendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                <x-atoms.forms.label class='mt-2 text-xl' for="thursday.{{$key}}">Thursday</x-atoms.label>
                            </div>
                            <div class="w-full p-4 text-center">
                                <input type="time" wire:model.live="fristartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                                <input type="time" wire:model.live="friendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                <x-atoms.forms.label class='mt-2 text-xl' for="friday.{{$key}}">Friday</x-atoms.label>
                            </div>
                            <div class="w-full p-4 text-center">
                                <input type="time" wire:model.live="satstartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                                <input type="time" wire:model.live="satendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                <x-atoms.forms.label class='mt-2 text-xl' for="saturday.{{$key}}">Saturday</x-atoms.label>
                            </div>
                            <div class="w-full p-4 text-center">
                                <input type="time" wire:model.live="sunstartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                                <input type="time" wire:model.live="sunendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                <x-atoms.forms.label class='mt-2 text-xl' for="sunday.{{$key}}">Sunday</x-atoms.label>
                            </div>
                        </div>
                    </x-atoms.forms.label>

                        {{-- useless for now --}}
                    <x-atoms.forms.label class="text-xl font-bold" for="callflow">Call Flow
                        <div class="grid grid-cols-5 text-xl font-bold">
                            <x-atoms.forms.button class='col-start-2 w-40 p-5'>
                                <x-atoms.icons.phone /> Ring Through
                            </x-atoms.forms.button>

                            <x-atoms.forms.button class='w-40 p-5'>
                                <x-atoms.icons.phone /> Multi Ring
                            </x-atoms.forms.button>

                            <x-atoms.forms.button class='w-40 p-5'>
                                <x-atoms.icons.phone /> Round Robin
                            </x-atoms.forms.button>
                        </div>
                    </x-atoms.forms.label>
            </fieldset>
            @endforeach
            @if(!empty($schedules))
            <x-atoms.forms.button class="mt-4 object-right-bottom" color="success" type="submit">Save Schedule</x-atoms.forms.button>
            @endif
        </form>
    </div>

</div>