<main>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">

            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{route('dashboard')}}" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{route('phone-settings')}}" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Phone Trackings</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{route('phone-settings-add-schedule', $PhoneID)}}" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Add Schedule</a>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Add Schedule</h1>
            </div>

            <form wire:submit.prevent="create()" class="space-y-4">
            <div class="mt-6 mb-6">
                <x-atoms.forms.label for="name">Name</x-atoms.label>
                    <x-atoms.forms.textbox type="text" wire:model="pnname" disabled/>
                <x-atoms.forms.validation for="form.name"/>
            </div>
           <div class='mb-6'>
                <x-atoms.forms.button type="button" color="success" wire:click.prevent="addSchedule({{$i}})">
                    <x-atoms.icons.addschedule />Add Schedule
                </x-atoms.forms.button>

                <x-atoms.forms.button type="button" color="secondary" wire:click.prevent="removeSchedule({{$i}})">
                    <x-atoms.icons.trash />Remove Schedule
                </x-atoms.forms.button>
           </div>

            @foreach($schedules as $key => $schedule)
            <fieldset class="block p-2.5 w-full text-sm text-gray-900 bg-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <legend class="text-2xl">
                    Business Hours # {{ " ". $key + $sets + 1}}
                </legend>
                <x-atoms.forms.label class="text-xl font-bold" for="fwd">Forwarded to
                    <x-atoms.forms.textbox type="text" wire:model="fwd.{{$key}}" wire:change="formatNumber({{$key}})" wire:keyup="formatNumber({{$key}})" />
                    <x-atoms.forms.validation for="form.fwd" />
                </x-atoms.label>
                <x-atoms.forms.label class="text-xl font-bold mt-10" for="schedule">Schedule
                    <div class="grid grid-cols-7">
                        <div class="w-full p-4 text-center box-border">
                            <input type="time" wire:model="monstartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <input type="time" wire:model="monendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-atoms.forms.label class='mt-2 text-xl' for="monday.{{$key}}">Monday</x-atoms.label>
                        </div>
                        <div class="w-full p-4 text-center">
                            <input type="time" wire:model="tuestartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <input type="time" wire:model="tueendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-atoms.forms.label class='mt-2 text-xl' for="tuesday.{{$key}}">Tuesday</x-atoms.label>
                        </div>
                        <div class="w-full p-4 text-center">
                            <input type="time" wire:model="wedstartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <input type="time" wire:model="wedendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-atoms.forms.label class='mt-2 text-xl' for="wednesday.{{$key}}">Wednesday</x-atoms.label>
                        </div>
                        <div class="w-full p-4 text-center">
                            <input type="time" wire:model="thustartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <input type="time" wire:model="thuendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-atoms.forms.label class='mt-2 text-xl' for="thursday.{{$key}}">Thursday</x-atoms.label>
                        </div>
                        <div class="w-full p-4 text-center">
                            <input type="time" wire:model="fristartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <input type="time" wire:model="friendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-atoms.forms.label class='mt-2 text-xl' for="friday.{{$key}}">Friday</x-atoms.label>
                        </div>
                        <div class="w-full p-4 text-center">
                            <input type="time" wire:model="satstartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <input type="time" wire:model="satendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-atoms.forms.label class='mt-2 text-xl' for="saturday.{{$key}}">Saturday</x-atoms.label>
                        </div>
                        <div class="w-full p-4 text-center">
                            <input type="time" wire:model="sunstartsched.{{ $key }}" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <input type="time" wire:model="sunendsched.{{ $key }}" class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-atoms.forms.label class='mt-2 text-xl' for="sunday.{{$key}}">Sunday</x-atoms.label>
                        </div>
                    </div>
                </x-atoms.forms.label>

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
                <x-atoms.forms.button class="mt-4 object-right-bottom" color="success" type="submit">Save Schedule</x-atoms.forms.button>
            </form>
        </div>

    </div>
</main>
