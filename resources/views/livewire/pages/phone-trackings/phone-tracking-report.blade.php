<main >
    <div class="px-4 pt-6">
        <div class="w-full mb-2">
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
                            <li>
                                <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <a href="" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Reports</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ $selectedCompany->name }}</h1>
                </div>
            </div>

        <div class="grid w-full mb-3 grid-cols-1 gap-4 mt-4 xl:grid-cols-4 2xl:grid-cols-2">
        <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="w-full">
                <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Num of Calls</h3>
                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $numOfCall }}</span>
                </div>
            </div>
            <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Num of Unique Calls</h3>
                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{$numOfUniqueCall}}</span>
                </div>
            </div>
        </div>

        <div>
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <x-organisms.table id="example">
                        <x-molecules.tables.thead>
                            <tr>
                                <x-atoms.tables.th>
                                    <x-atoms.forms.checkbox id="checkbox-all" checked />
                                </x-atoms.tables.th>
                                <x-atoms.tables.th>From</x-atoms.tables.th>
                                <x-atoms.tables.th>To</x-atoms.tables.th>
                                <x-atoms.tables.th>Duration</x-atoms.tables.th>
                                <x-atoms.tables.th>Recording</x-atoms.tables.th>
                                <x-atoms.tables.th>Price</x-atoms.tables.th>
                                <x-atoms.tables.th>Created At</x-atoms.tables.th>
                            </tr>
                        </x-molecules.tables.thead>
                        <x-molecules.tables.tbody>
                            <audio id="playAudio" class="hidden">
                                <source src="{{ $currentRecording }}" type="audio/mp3">
                                Your browser does not support the audio element.
                            </audio>

                            @foreach ($calls['calls'] as $call)
                                <tr>
                                    <x-atoms.tables.td>
                                        <x-atoms.forms.checkbox id="checkbox-{{$call['sid']}}" checked />
                                    </x-atoms.tables.td>
                                    <x-atoms.tables.td>{{ $call['from'] }}</x-atoms.tables.td>
                                    <x-atoms.tables.td>{{ $call['to'] }}</x-atoms.tables.td>
                                    <x-atoms.tables.td>{{ $call['duration'] }}</x-atoms.tables.td>
                                    <x-atoms.tables.td>
                                        @php
                                            $class = "inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700";
                                            if(($currentPlayButton == $call['sid']) && $readyToPlay){
                                                $class = 'inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg  bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 sm:w-auto dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800';
                                            }

                                            if(($currentPlayButton == $call['sid']) && !$currentRecording){
                                                $class = 'inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg  bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800';
                                            }
                                        @endphp
                                        <div class="flex items-center">
                                        <button wire:click="playRecording('{{ $call['sid'] }}', '{{ $call['subresource_uris']['recordings'] }}')" class="{{ $class }}">
                                            @if( ($currentPlayButton == $call['sid']) && $currentRecording)
                                                @if ($playRecording)
                                                    Loading
                                                @elseif ($readyToPlay)
                                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 16">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m2.707 14.293 5.586-5.586a1 1 0 0 0 0-1.414L2.707 1.707A1 1 0 0 0 1 2.414v11.172a1 1 0 0 0 1.707.707Z"/>
                                                    </svg> Listening
                                                @else
                                                    Play Audio
                                                @endif
                                            @elseif( ($currentPlayButton == $call['sid']) && !$currentRecording)
                                                No Audio
                                            @else
                                                Play Audio
                                            @endif
                                        </button>
                                    </x-atoms.tables.td>
                                    <x-atoms.tables.td>{{ $call['price'] }}</x-atoms.tables.td>
                                    <x-atoms.tables.td>{{ $call['date_created'] }}</x-atoms.tables.td>

                                </tr>
                            @endforeach
                        </x-molecules.tables.tbody>
                    </x-organisms.table>
                </div>
            </div>
       </div>

    </div>
</main>


@push('scripts')
<script>
    
</script>
@endpush