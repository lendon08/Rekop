<main>
    <div id="large-modal" data-modal-backdrop="popup-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow ">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="large-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5">
                    <h3 class="text-xl font-semibold text-gray-900">Exit Number Creation Wizard?</h3>
                    <h4 class="mb-5 text-lg font-semibold text-gray-700 text-justify">The settings and tracking numbers you've chosen won't be saved.</h4>

                    <div class="flex justify-center gap-3">
                        <button data-modal-hide="large-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                            No, cancel</button>
                        <a data-modal-hide="large-modal" href="{{route('dashboard')}}" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes, I'm sure
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-60 text-center">
        <h1 class="mb-2 pt-4 text-3xl font-bold text-gray-900">Create Tracking Number</h1>
        <button data-modal-target="large-modal" data-modal-toggle="large-modal" class="absolute top-5 end-5 text-gray-500 font-medium text-xl px-5 py-2.5 text-center type=" button">
            &times;
        </button>
        <p class="mb-5 text-base text-gray-500 sm:text-lg ">Company Name</p>

        <div class="my-4 w-full">
            <progress id="file" value="{{ $percent[$pageCnt] }}" max="100" class="w-full progress-unfilled:bg-gray-300 progress-filled:bg-blue-700"> </progress>
            <label for="file" class="w-1/4">{{ $percent[$pageCnt] }}% Complete</label>
        </div>
    </div>


    <div class="mx-60 my-16 text-center ">
        <div class="px-6 rounded-lg {{ $pageCnt >= 4 ? 'bg-white' : '' }} -mt-10 pt-4">

            <div class="{{ $pageCnt == 0 ? '' : 'hidden' }}">
                <p class="mb-5 text-xl text-left sm:text-xl font-semibold">Where will you display this tracking number?</p>

                <div class="w-full mb-10 items-center justify-center space-y-10 sm:flex sm:space-y-0 sm:mt-10 space-x-10  rtl:space-x-reverse">
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5"
                            wire:click="Increase(1)">
                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">On my Website</div>
                                <div class="mb-1 text-base text-gray-500">We'll provide the code to install call tracking.</div>
                            </div>
                        </button>
                    </div>
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5"
                            wire:click="Increase(1)">
                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">Somewhere else</div>
                                <div class="mb-1 text-base text-gray-500">Google Ads, email signatures, and more.</div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- -------------------------------------------------------------------------------------------------------------------- -->

            <div class="{{ $pageCnt == 1 ? '' : 'hidden' }}">
                <p class="mb-5 text-xl text-left sm:text-xl font-semibold">What would you like to track?</p>

                <div class="w-full mb-10 items-center justify-center space-y-10 sm:flex sm:space-y-0 sm:mt-10 space-x-10  rtl:space-x-reverse">
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5"
                            wire:click="Increase(1)">

                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">Calls, keywords, & Web sessions</div>
                                <div class="mb-1 text-base text-gray-500">Use a website pool to track details from campaigns and web sessions.</div>
                            </div>
                        </button>
                    </div>
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5"
                            wire:click="Increase(1)">

                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">Calls only</div>
                                <div class="mb-1 text-base text-gray-500">Use one number to track all calls to a single campaign.</div>
                            </div>
                        </button>
                    </div>

                </div>
            </div>

            <!-- -------------------------------------------------------------------------------------------------------------------- -->

            <div class="{{ $pageCnt == 2 ? '' : 'hidden' }}">
                <p class="mb-5 text-xl text-left sm:text-xl font-semibold">Will this number be used in a Google Ads extension?</p>

                <div class="w-full mb-10 items-center justify-center space-y-10 sm:flex sm:space-y-0 sm:mt-10 space-x-10  rtl:space-x-reverse">
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5"
                            wire:click="Increase(1)">

                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">Yes, in an ad extension.</div>
                                <div class="mb-1 text-base text-gray-500">Call only ads, call extensions, and message extension.</div>
                            </div>
                        </button>
                    </div>
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5"
                            wire:click="Increase(1)">

                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">No, somewhere else.</div>
                                <div class="mb-1 text-base text-gray-500">Facebook ads, email signatures, and more).</div>
                            </div>
                        </button>
                    </div>

                </div>
            </div>

            <!-- -------------------------------------------------------------------------------------------------------------------- -->

            <div class="{{ $pageCnt == 3 ? '' : 'hidden' }}">
                <p class="mb-5 text-xl text-left sm:text-xl font-semibold">Where will your Google ads be displayed?</p>

                <div class="w-full mb-10 items-center justify-center space-y-10 sm:flex sm:space-y-0 sm:mt-10 space-x-10  rtl:space-x-reverse">
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5"
                            wire:click="Increase(1)">

                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">Only on mobile devices.</div>
                                <div class="mb-1 text-base text-gray-500">You have call-only campaign or a campaign targeting mobile devices.</div>
                            </div>
                        </button>
                    </div>
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5"
                            wire:click="Increase(1)">

                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">On desktop and mobile devices.</div>
                                <div class="mb-1 text-base text-gray-500">You have a campaign that is targeting multiple devices.</div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- -----------------------------Tracking Options--------------------------------------------------------------- -->
            @include('livewire.pages.settings.create-number.pagefour')

            <!----------------------------------------Call Forwarding------------------------------------------------------------------------------ -->
            @include('livewire.pages.settings.create-number.pageFive')

            <!----------------------------------------Number Setup------------------------------------------------------------------------------ -->
            @include('livewire.pages.settings.create-number.pageSix')

            <!----------------------------------------Activation of Number------------------------------------------------------------------------------ -->
            @include('livewire.pages.settings.create-number.pageSeven')
        </div>
    </div>


    @if ($pageCnt>0)
    <div class="fixed bottom-0 left-0 z-40 grid w-full h-16 grid-cols-1 px-8 bg-white border-t border-gray-200 md:grid-cols-2 ">
        <div class="items-center justify-center hidden text-gray-500 me-auto md:flex">
            <svg class="w-6 h-6 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
            </svg>
            <button type="button" class="p-2.5 group text-blue-700 hover:text-blue-800 hover:scale-105 me-1 focus:outline-none focus:ring-4 focus:ring-gray-200"
                wire:click="Decrease(1)">
                {{ $pages[$pageCnt-1]}}
            </button>

        </div>



        <div class="items-center justify-center hidden ms-auto md:flex">


        @if($pageCnt==4)
            <button type="button"
                class="p-2.5 group bg-blue-700 text-white hover:bg-blue-800 me-1 focus:outline-none focus:ring-4 focus:ring-gray-200"
                wire:click="Increase(1)"
                :class="{ 'bg-gray-400 cursor-not-allowed': !$wire.swapTarget }"
                :disabled="$wire.swapTarget == ''">
                {{ $pages[$pageCnt] }}
            </button>

        @elseif($pageCnt==5)
            <button type="button" class="p-2.5 group bg-blue-700 text-white hover:bg-blue-800 me-1 focus:outline-none focus:ring-4 focus:ring-gray-200"
                wire:click="Increase(1)"
                :class="{ 'bg-gray-400 cursor-not-allowed': !$wire.callForwarding }"
                :disabled="$wire.callForwarding == ''">
                {{ $pages[$pageCnt] }}
            </button>

        @elseif($pageCnt==6)
            <button type="button" class="p-2.5 group bg-blue-700 text-white hover:bg-blue-800 me-1 focus:outline-none focus:ring-4 focus:ring-gray-200"
                wire:click="store()">
                {{ $pages[$pageCnt] }}
            </button>
        @else
            <button type="button" class="p-2.5 group bg-blue-700 text-white hover:bg-blue-800 me-1 focus:outline-none focus:ring-4 focus:ring-gray-200"
                wire:click="store()">
                {{ $pages[$pageCnt] }}
            </button>
        @endif

        </div>

    </div>

    @endif
</main>
