<main>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
           
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Phone Trackings</a>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Phone Settings</h1>
            </div>
            <div class="sm:flex">
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <button type="button" wire:click="createPhoneNum" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-primary-800">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Add Phone Number 
                    </button>
                    <a href="{{ route('call-histories', 3) }}" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path></svg>
                        View Call Histories
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    @if(isset($phoneNumbers['data']))
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <x-organisms.table>
                    <x-molecules.tables.thead>
                        <tr>
                            <x-atoms.tables.th>ID</x-atoms.tables.th>
                            <x-atoms.tables.th>Number</x-atoms.tables.th>
                            <x-atoms.tables.th>Bin Use</x-atoms.tables.th>
                            <x-atoms.tables.th>Action</x-atoms.tables.th>
                        </tr>
                    </x-molecules.tables.thead>

                    <x-molecules.tables.tbody>
                        @foreach ($phoneNumbers['data'] as $phoneNumber)
                            <tr>
                                <x-atoms.tables.td>
                                    <div class="text-base font-semibold text-gray-900 dark:text-white">
                                        {{ Str::limit($phoneNumber['name'] ?? $phoneNumber['number'] , 50, ' ...') }}
                                    </div>
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $phoneNumber['id'] }}</div>
                                </x-atoms.tables.td>
                                <x-atoms.tables.td>{{ $phoneNumber['number'] }}</x-atoms.tables.td>
                                <x-atoms.tables.td>{{ $phoneNumber['bin_name'] }}</x-atoms.tables.td>
                                <x-atoms.tables.td>
                                    <!-- TODO -->
                                    <button wire:click="editPhoneNum('{{$phoneNumber['id']}}')" 
                                    name="something"
                                    class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                        Edit
                                    </button>
                                </x-atoms.tables.td>
                            </tr>
                        @endforeach
                    </x-molecules.tables.tbody>
                </x-organisms.table>
            </div>
        </div>
    @endif
</main>

