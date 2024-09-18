<main class="px-2 space-y-4">
    <div class="p-6 w-full text-2xl font-bold sm:p-6">
        Phone Setting
    </div>
    <div class="bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">


            <div class="sm:flex" >
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <button type="button" wire:click="buyPhoneNum" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 sm:w-auto ">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add Phone Number
                    </button>
                    <a href="{{ route('call-histories', 3) }}" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                        </svg>
                        View Call Histories
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div>
            <x-organisms.table>
                <x-molecules.tables.thead>
                    <tr>
                        <x-atoms.tables.th>Number Name</x-atoms.tables.th>
                        <x-atoms.tables.th>Tracking Number</x-atoms.tables.th>
                        <x-atoms.tables.th>Number of Schedules</x-atoms.tables.th>
                        <x-atoms.tables.th>Actions</x-atoms.tables.th>
                    </tr>
                </x-molecules.tables.thead>

                <x-molecules.tables.tbody>
                    @foreach ($phoneNumbers['data'] as $key => $phoneNumber)
                    <tr>

                        <x-atoms.tables.td>
                            <div class="text-base font-semibold text-gray-900">
                                {{ Str::limit($phoneNumber['name'] ?? $phoneNumber['number'] , 50, ' ...') }}
                            </div>
                            <div class="text-sm font-normal text-gray-500">{{ $phoneNumber['id'] }}</div>
                        </x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $phoneNumber['number'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td class='text-center'>{{ $phoneNumber['sets'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td class="pb-8">
                            <!-- TODO -->
                            <div class="relative">
                                <div class="absolute top-0 right-0">
                                    <x-atoms.forms.button wire:click="addPhoneNum('{{$phoneNumber['id']}}')" type="button" data-popover-target="add-schedule-{{$key}}">
                                        <x-atoms.icons.addschedule />
                                    </x-atoms.forms.button>
                                    <div data-popover id="add-schedule-{{$key}}" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0">
                                        <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg">
                                            <h3 class="font-semibold text-gray-900">Add Schedule</h3>
                                        </div>
                                        <div data-popper-arrow></div>
                                    </div>

                                    <x-atoms.forms.button wire:click="editPhoneNum('{{$phoneNumber['id']}}')" type="button" data-popover-target="edit-schedule-{{$key}}">
                                        <x-atoms.icons.edit />
                                    </x-atoms.forms.button>
                                    <div data-popover id="edit-schedule-{{$key}}" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0">
                                        <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg">
                                            <h3 class="font-semibold text-gray-900">Edit Schedule</h3>
                                        </div>
                                        <div data-popper-arrow></div>
                                    </div>
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