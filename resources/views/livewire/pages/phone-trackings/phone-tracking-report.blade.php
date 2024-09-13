<div class="px-4 pt-6">


    <div class="grid w-full mb-3 grid-cols-1 gap-4 mt-4 xl:grid-cols-4 2xl:grid-cols-2">
        <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex sm:p-6">
            <div class="w-full">
                <h3 class="text-base font-normal text-gray-500">Num of Calls</h3>
                <span class="text-2xl font-bold leading-none sm:text-3xl">{{ $numOfCall }}</span>
            </div>
        </div>
        <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex sm:p-6">
            <div class="w-full">
                <h3 class="text-base font-normal text-gray-500">Num of Unique Calls</h3>
                <span class="text-2xl font-bold leading-none sm:text-3xl">{{$numOfUniqueCall}}</span>
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
                                $class = "inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto";
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
                    </x-molecules.tables.tbody>
                </x-organisms.table>
            </div>
        </div>
    </div>

</div>



@push('scripts')
<script>

</script>
@endpush