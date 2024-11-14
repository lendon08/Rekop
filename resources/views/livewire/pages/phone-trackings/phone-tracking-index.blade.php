<main class="px-2 space-y-4">
    <div class="p-6 w-full text-2xl font-bold sm:p-6">
        Phone Setting
    </div>
    <div class="bg-white block sm:flex border-b border-gray-200 p-4">
        <div class="w-full mb-1">

            <div class="sm:flex" >
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <x-atoms.forms.button href="{{ route('wizard')}}" variant="primary">
                        Create Number
                    </x-atoms.forms.button>
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
                    @foreach ($phoneNumbers['data'] as $key => $phoneNumber)
                    <tr>
                        <x-atoms.tables.td>
                            <x-atoms.forms.button wire:click="editPhoneTracking('{{ $phoneNumber['id'] }}')" class="text-blue-800">
                                {{ Str::limit($phoneNumber['name'] ?? $phoneNumber['number'] , 50, ' ...') }}
                            </x-atoms.forms.button>

                            <div class="text-sm font-normal text-gray-500">{{ $phoneNumber['id'] }}</div>
                        </x-atoms.tables.td>
                        <x-atoms.tables.td>All</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $phoneNumber['number'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td>TODO Numbers</x-atoms.tables.td>
                        <x-atoms.tables.td>TODO Numbers</x-atoms.tables.td>
                        <x-atoms.tables.td>TODO Numbers</x-atoms.tables.td>

                        <x-atoms.tables.td class='text-center'>{{ $phoneNumber['sets'] }}</x-atoms.tables.td>
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
                </x-molecules.tables.tbody>
            </x-organisms.table>
        </div>
    </div>
</main>
