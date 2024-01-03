<div class="flex mt-10">
    <div class="flex-auto pl-10 text-6xl font-black">INVOICE</div>
    <div class="flex flex-col flex-auto pr-10 text-2xl text-right">
        <span class="font-black">Place</span>
        <span>Address #1</span>
        <span>Address #2</span>
    </div>
</div>

<div class="flex mt-2">
    <div class="flex flex-col flex-auto pl-10 text-xl">
        <span class="font-black">Place</span>
        <span>Address #1</span>
        <span>Address #2</span>
    </div>
    <div class="flex flex-col flex-auto pr-10 text-2xl text-right">
        <span>INVOICE #</span>
            <!-- get from database -->
        <span>INV-00002</span>
    </div>
</div>

<div class="flex mt-10 bg-green-500 text-gray-100">
    <div class="flex flex-col flex-auto pl-10 text-2xl">
        <span>INVOICE DATE</span>
        <span class='bg-white text-black'>December 15, 2023</span>
    </div>
    <div class="flex flex-col flex-auto text-2xl">
        <span>TERMS</span>
        <span class='bg-white text-black'>December 15, 2023</span>
    </div>
    <div class="flex flex-col flex-auto text-2xl">
        <span>DUE DATE</span>
        <span class='bg-white text-black'>December 15, 2023</span>
    </div>
</div>

<div class="w-full pl-10 mt-20 text-base">
    <div class="overflow-x-auto">
        <table class="w-full rounded border-black border-solid"> 
            <thead>
                <tr>
                    <th>#</th>
                    <th>FROM</th>
                    <th>TO</th>
                    <th>DURATION</th>
                    <th>CALL DIRECTION</th>
                    <th>PRICE</th>
                    <th>DATE/TIME OF CALL</th>
                    <th>RECORDING</th>
                </tr>
            </thead>
            <tbody>
                <audio id="playAudio" class="hidden">
                    <source src="{{ $currentRecording }}" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>
                @foreach ($calls as $key => $call)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $call['formatted_from'] }}</td>
                        <td>{{ $call['formatted_to'] }}</td>
                        <td>{{ gmdate("H:i:s", $call['duration']) }}</td>
                        <td>{{ ucfirst(str_replace("-dial","", $call['direction'])) }}</td>
                        <td>{{ $call['price'] }}</td>
                        <td>{{ $call['date_created'] }}</td>
                        <td>
                            @php
                            $class = "inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto bg-gray-800";
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
                        </td>
                        
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"></td>
                        <td>TOTAL PRICE</td>
                        <td><strong>{{ $total * $multiply }}</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>


<!-- <div class="flex flex-col">
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
                    <x-atoms.tables.th>{{ $call['formatted_from'] }}</x-atoms.tables.th>
                    <x-atoms.tables.th>{{ $call['formatted_to'] }}</x-atoms.tables.th>
                    <x-atoms.tables.th>{{ gmdate("H:i:s", $call['duration']) }}</x-atoms.tables.th>
                    <x-atoms.tables.th>{{ ucfirst(str_replace("-dial","", $call['direction'])) }}</x-atoms.tables.th>
                    <x-atoms.tables.th>
                        @php
                        $class = "inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto bg-gray-800";
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
                    </x-atoms.tables.th>
                    <x-atoms.tables.th>{{ $call['price'] }}</x-atoms.tables.th>
                    <x-atoms.tables.th>{{ $call['date_created'] }}</x-atoms.tables.th>
                </tr>
                @endforeach
                <tr>
                    <x-atoms.tables.th colspan="3"></x-atoms.tables.th>
                    <x-atoms.tables.th>TOTAL PRICE</x-atoms.tables.th>
                    <x-atoms.tables.th><strong>{{ $total * $multiply }}</strong></x-atoms.tables.th>
                    <x-atoms.tables.th></x-atoms.tables.th>
                    <x-atoms.tables.th></x-atoms.tables.th>
                </tr>
            </x-molecules.tables.tbody>
        </x-organisms.table>
    </div>
</div> -->

<!-- <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between ">
    <div class="flex items-center hidden mb-4 sm:mb-0 sm:flex">
    </div>
    <div class="flex items-center space-x-3">
        <a href="#" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300">
            <svg class="w-5 h-4 mr-1 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z" />
                <path d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z" />
            </svg> Print
        </a>
        <a href="{{ route('call-histories') }}" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300">
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
</div> -->


