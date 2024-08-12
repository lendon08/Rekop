<main>

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-gray-700 hover:text-primary-600">
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
                                <a href="" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2">Invoice</a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="grid w-full mb-3 grid-cols-1 gap-4 mt-4 xl:grid-cols-4 2xl:grid-cols-2">
                <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex sm:p-6">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500">Num of Calls</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">{{ $numOfCall }}</span>
                    </div>
                </div>
                <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex sm:p-6">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500">Lead Value</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">{{ $multiplier }}</span>
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

                        <x-atoms.tables.th>From </x-atoms.tables.th>
                        <x-atoms.tables.th>To </x-atoms.tables.th>
                        <x-atoms.tables.th>Duration </x-atoms.tables.th>
                        <x-atoms.tables.th>Call Type </x-atoms.tables.th>
                        <x-atoms.tables.th>Recording</x-atoms.tables.th>
                        <x-atoms.tables.th>Price </x-atoms.tables.th>
                        <x-atoms.tables.th>Created At </x-atoms.tables.th>
                    </tr>
                </x-molecules.tables.thead>
                <x-molecules.tables.tbody>
                    <audio id="playAudio" class="hidden">
                        <source src="{{ $currentRecording }}" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                    @foreach ($calls as $call)
                    <tr>
                        <x-atoms.tables.td>{{ $call['formatted_from'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $call['formatted_to'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ gmdate("H:i:s", $call['duration']) }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ ucfirst(str_replace("-dial","", $call['direction'])) }}</x-atoms.tables.td>
                        <x-atoms.tables.td>
                            @php
                            $class = "inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto";
                            if(($currentPlayButton == $call['sid']) && $readyToPlay){
                            $class = 'inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 sm:w-auto';
                            }

                            if(($currentPlayButton == $call['sid']) && !$currentRecording){
                            $class = 'inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 sm:w-auto';
                            }
                            @endphp
                            <div class="flex items-center">
                                <button wire:click="playRecording('{{ $call['sid'] }}', '{{ $call['subresource_uris']['recordings'] }}')" class="{{ $class }}">
                                    @if( ($currentPlayButton == $call['sid']) && $currentRecording)
                                    @if ($playRecording)
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
                        <x-atoms.tables.td>{{ $call['price'] }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $call['date_created'] }}</x-atoms.tables.td>
                    </tr>
                    @endforeach
                    <tr>
                        <x-atoms.tables.td colspan="3"></x-atoms.tables.td>
                        <x-atoms.tables.td>TOTAL PRICE</x-atoms.tables.td>
                        <x-atoms.tables.td><strong>{{ $total * $multiplier }}</strong></x-atoms.tables.td>
                        <x-atoms.tables.td></x-atoms.tables.td>
                        <x-atoms.tables.td></x-atoms.tables.td>
                    </tr>
                </x-molecules.tables.tbody>
            </x-organisms.table>
        </div>
    </div>

    <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between">
        <div class="flex items-center hidden mb-4 sm:mb-0 sm:flex">
        </div>
        <div class="flex items-center space-x-3">
            <a href="#" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300">
                <svg class="w-5 h-4 mr-1 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z" />
                    <path d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z" />
                </svg> Print
            </a>
            <a href="{{ route('call-histories', ['company'=> $selectedCompany->id]) }}" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300">
                <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Back
            </a>
            <a href="#" wire:click="paymentReport" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300">
                <svg class="w-5 h-4 mr-1 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                    <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                </svg>
                Payment
            </a>

        </div>
    </div>


</main>