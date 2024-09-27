<main class="px-2 space-y-4">
    <div class="p-6 w-full text-2xl font-bold sm:p-6">
        Call History
    </div>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 rounded-lg lg:mt-1.5">
        <div class="w-full mb-1">


            <div class="grid w-full mb-3 grid-cols-1 gap-4 mt-4 xl:grid-cols-4 2xl:grid-cols-2">
                <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex sm:p-6">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500">Num of Calls</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">{{ $numOfCall }}</span>
                    </div>
                </div>
                <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex sm:p-6">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500">Num of Unique Calls</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">{{ $numOfUniqueCall}}</span>
                    </div>
                </div>
            </div>

            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0">
                    <form class="lg:pr-3" action="#" method="GET">
                        <label for="companies-search" class="sr-only" wire:model.live="search">Search</label>
                        <div class="relative mt-1 lg:w-64 xl:w-96">
                            <input type="text" name="email" id="companies-search" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 " 
                            placeholder="Search Calls" autocomplete="false">
                        </div>
                    </form>
                    <div class="flex pl-0 mt-3 space-x-3 sm:pl-3 sm:mt-0">
                        <x-atoms.forms.button class="border-gray-300 border-2 p-2" wire:click.prevent="">
                            <x-atoms.icons.filter></x-atoms.icons.filter>
                            Filters
                        </x-atoms.forms.button>
                        <x-atoms.forms.button class="border-gray-300 border-2 p-2" wire:click.prevent="">
                            <x-atoms.icons.download></x-atoms.icons.download>
                            Generate Report
                        </x-atoms.forms.button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <x-organisms.table>
                <x-molecules.tables.thead>
                    <tr>
                        <x-atoms.tables.th>
                            <x-atoms.forms.checkbox wire:model.live="selectAll" id="checkbox-all" />
                        </x-atoms.tables.th>
                        <x-atoms.tables.th wire:click="sortBy('formatted_from')">
                            From @if($sortField === 'formatted_from') <span>{!! $sortDirection === 'asc' ? '&#x25B2;' : '&#x25BC;' !!}</span> @endif
                        </x-atoms.tables.th>

                        <x-atoms.tables.th wire:click="sortBy('formatted_to')">
                            To @if($sortField === 'formatted_to') <span>{!! $sortDirection === 'asc' ? '&#x25B2;' : '&#x25BC;' !!}</span> @endif
                        </x-atoms.tables.th>
                        <x-atoms.tables.th wire:click="sortBy('duration')">
                            Duration @if($sortField === 'duration') <span>{!! $sortDirection === 'asc' ? '&#x25B2;' : '&#x25BC;' !!}</span> @endif
                        </x-atoms.tables.th>
                        <x-atoms.tables.th wire:click="sortBy('direction')">
                            Call Direction @if($sortField === 'direction') <span>{!! $sortDirection === 'asc' ? '&#x25B2;' : '&#x25BC;' !!}</span> @endif
                        </x-atoms.tables.th>
                        <x-atoms.tables.th wire:click="sortBy('price')">
                            Price @if($sortField === 'price') <span>{!! $sortDirection === 'asc' ? '&#x25B2;' : '&#x25BC;' !!}</span> @endif
                        </x-atoms.tables.th>
                        <x-atoms.tables.th wire:click="sortBy('date_created')">
                            Date of Call @if($sortField === 'date_created') <span>{!! $sortDirection === 'asc' ? '&#x25B2;' : '&#x25BC;' !!}</span> @endif
                        </x-atoms.tables.th>
                        <x-atoms.tables.th>Recording</x-atoms.tables.th>
                    </tr>
                </x-molecules.tables.thead>
                <x-molecules.tables.tbody>
                    <audio id="playAudio" class="hidden">
                        <source src="{{ $currentRecording }}" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                    

                    @foreach ($calls as $key => $call)
                    <tr wire:key="call-{{ $key }}">
                        <x-atoms.tables.td>
                            <x-atoms.forms.checkbox id="checkbox-{{$call['sid']}}" wire:model.live="selectedItems" value="{{ $call['sid'] }}" />
                        </x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $call['formatted_from'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $call['formatted_to'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $call['duration'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $call['direction'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $call['price'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $call['date_created']}}</x-atoms.tables.td>
                        <x-atoms.tables.td>
                            @php
                                $class = "inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto";
                                if(($currentPlayButton == $call['sid']) && $readyToPlay){
                                    $class = 'inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 sm:w-auto';   
                                }
                                elseif(($currentPlayButton == $call['sid']) && !$currentRecording){
                                    $class = 'inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 sm:w-auto';
                                }
                            @endphp
                            <div class="flex items-center">
                                <button wire:click="playRecording('{{ $call['sid'] }}', '{{ $call['subresource_uris']['recordings'] }}')" class="{{ $class }}">
                                    @if( ($currentPlayButton == $call['sid']) && $currentRecording)
                                        @if ($playRecordingBool)
                                        Loading
                                        @elseif ($readyToPlay)
                                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m2.707 14.293 5.586-5.586a1 1 0 0 0 0-1.414L2.707 1.707A1 1 0 0 0 1 2.414v11.172a1 1 0 0 0 1.707.707Z" />
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

                    </tr>
                    @endforeach
                </x-molecules.tables.tbody>
            </x-organisms.table>
        </div>
    </div>
    <div class="fixed bottom-0 pt-4 left-1 pl-16 z-40 grid w-full h-16 grid-cols-1 px-8 bg-white border-t border-gray-200 justify-between">
        {{ $calls->links() }}
    </div>
    
    </div>