<div class="p-6 w-full text-2xl font-bold sm:p-6">
    Phone Settings
</div>

<div class="bg-white block sm:flex border-b border-gray-200 p-4">

    <div class="flex justify-between w-full">
        <div>
            <x-atoms.forms.button href="{{ route('wizard')}}" variant="primary">
                Create Number
            </x-atoms.forms.button>
        </div>
        <div class="flex items-center space-x-4">

            <x-atoms.forms.button wire:click.prevent="showPhoneNumber(true)">
                Active ({{ $phoneNumbersCount }})
            </x-atoms.forms.button>
            <x-atoms.forms.button wire:click.prevent="showPhoneNumber(false)">
                Deactivated ({{ $deactivatedCount }})
            </x-atoms.forms.button>


            <div class="flex-grow lg:w-64 xl:w-96">
                <label for="companies-phone-number" class="sr-only">Search</label>
                <input type="text"
                       wire:model.live="search"
                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full p-2.5"
                       placeholder="Search for Tracking Number or Number Name">
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col">
    <x-organisms.table>
        <x-molecules.tables.thead>
            <tr>
                <x-atoms.tables.th>Number Name</x-atoms.tables.th>
                <x-atoms.tables.th>Source</x-atoms.tables.th>
                <x-atoms.tables.th>Tracking Number</x-atoms.tables.th>
                <x-atoms.tables.th>Forward Calls To</x-atoms.tables.th>
                <x-atoms.tables.th>Call Recording</x-atoms.tables.th>
                <x-atoms.tables.th>Status</x-atoms.tables.th>
                <x-atoms.tables.th>Number of Schedules</x-atoms.tables.th>
                <x-atoms.tables.th>Actions</x-atoms.tables.th>
            </tr>
        </x-molecules.tables.thead>

        <x-molecules.tables.tbody>
            @if($active)
                @foreach ($phoneNumbers as $key => $phoneNumber)
                <tr>
                    <x-atoms.tables.td>
                        <x-atoms.forms.button wire:click="editPhoneTracking('{{ $phoneNumber->id }}')" class="text-blue-800">
                            {{ Str::limit($phoneNumber->name ?? $phoneNumber->number , 50, ' ...') }}
                        </x-atoms.forms.button>

                        <div class="pl-2 text-sm font-normal text-gray-500">{{ $phoneNumber['id'] }}</div>
                    </x-atoms.tables.td>
                    @if( $phoneNumber->tracking->tracking_options->value == "Landing Page" )
                        <x-atoms.tables.td>Landing: {{ $phoneNumber->tracking->URL }}</x-atoms.tables.td>
                    @else
                        <x-atoms.tables.td>{{ $phoneNumber->tracking->tracking_options }}</x-atoms.tables.td>
                    @endif
                    <x-atoms.tables.td>{{ $phoneNumber->number }}</x-atoms.tables.td>

                    <x-atoms.tables.td>{{$phoneNumber->tracking->swaptarget}}</x-atoms.tables.td>
                    <x-atoms.tables.td>
                        {{$phoneNumber->tracking->recordingflag? "On" : "Off"}}
                    </x-atoms.tables.td>
                    <x-atoms.tables.td>Active</x-atoms.tables.td>


                    <x-atoms.tables.td class='text-center'>{{ $phoneSets[$key]['sets'] }}</x-atoms.tables.td>
                    <x-atoms.tables.td class="pb-8">
                        <!-- TODO -->
                        <div class="relative">
                            <div class="absolute top-0 right-0">
                                <x-atoms.forms.button wire:click="addPhoneNum('{{$phoneNumber['id']}}')" data-popover-target="add-schedule-{{$key}}">
                                    <x-atoms.icons.addschedule />
                                </x-atoms.forms.button>
                                <x-atoms.popover id="add-schedule-{{ $key }}">Add Schedule</x-atoms.popover>
                                <x-atoms.forms.button wire:click="editPhoneNum('{{$phoneNumber['id']}}')" data-popover-target="edit-schedule-{{$key}}">
                                    <x-atoms.icons.edit />
                                </x-atoms.forms.button>
                                <x-atoms.popover id="edit-schedule-{{ $key }}">Edit Schedule</x-atoms.popover>
                            </div>
                        </div>
                    </x-atoms.tables.td>
                </tr>
                @endforeach
            @else
                @foreach ($deactivated as $key => $phoneNumber)
                <tr>
                    <x-atoms.tables.td>
                        <x-atoms.forms.button wire:click="editPhoneTracking('{{ $phoneNumber->id }}')" class="text-blue-800">
                            {{ Str::limit($phoneNumber->name ?? $phoneNumber->number , 50, ' ...') }}
                        </x-atoms.forms.button>

                        <div class="pl-2 text-sm font-normal text-gray-500">{{ $phoneNumber['id'] }}</div>
                    </x-atoms.tables.td>
                    @if( $phoneNumber->tracking->tracking_options->value == "Landing Page" )
                        <x-atoms.tables.td>Landing: {{ $phoneNumber->tracking->URL }}</x-atoms.tables.td>
                    @else
                        <x-atoms.tables.td>{{ $phoneNumber->tracking->tracking_options }}</x-atoms.tables.td>
                    @endif
                    <x-atoms.tables.td>{{ $phoneNumber->number }}</x-atoms.tables.td>

                    <x-atoms.tables.td>{{$phoneNumber->tracking->swaptarget}}</x-atoms.tables.td>
                    <x-atoms.tables.td>
                        {{$phoneNumber->tracking->recordingflag? "On" : "Off"}}
                    </x-atoms.tables.td>
                    <x-atoms.tables.td>Active</x-atoms.tables.td>


                    <x-atoms.tables.td class='text-center'></x-atoms.tables.td>
                    <x-atoms.tables.td class="pb-8">
                        <!-- TODO -->
                        <div class="relative">
                            <div class="absolute top-0 right-0">
                                <x-atoms.forms.button wire:click="addPhoneNum('{{$phoneNumber['id']}}')" data-popover-target="add-schedule-{{$key}}">
                                    <x-atoms.icons.addschedule />
                                </x-atoms.forms.button>
                                <x-atoms.popover id="add-schedule-{{ $key }}">Add Schedule</x-atoms.popover>
                                <x-atoms.forms.button wire:click="editPhoneNum('{{$phoneNumber['id']}}')" data-popover-target="edit-schedule-{{$key}}">
                                    <x-atoms.icons.edit />
                                </x-atoms.forms.button>
                                <x-atoms.popover id="edit-schedule-{{ $key }}">Edit Schedule</x-atoms.popover>
                            </div>
                        </div>
                    </x-atoms.tables.td>
                </tr>
                @endforeach
            @endif

        </x-molecules.tables.tbody>
    </x-organisms.table>
</div>
</div>
