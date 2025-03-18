<div class="p-4">

    @if(empty($codeBlocks))
        <button
            class="my-4 px-4 py-2 text-blue-500 rounded hover:text-white hover:bg-blue-600"
            wire:click="chooseMenu('OPMENU', 1)">
            + Insert Step Here
        </button>

    @endif

    <div class="space-y-4 max-w-full m-1/2">
        @foreach ($codeBlocks as $block)
            @if($block['type'] == "OPMENU")
            <div
                class="p-4 border rounded shadow-sm bg-white w-full"
                id="block-{{ $block['id'] }}">
                <div class="flex justify-center items-center">
                    <h4 class="font-bold text-lg">What would you like to happen?</h4>
                </div>

                <div class="mt-2 text-gray-700">
                    <div class="grid grid-cols-5 gap-4 p-4">
                        <button
                            class="hover:border hover:border-blue-700 px-10 rounded transition duration-200 flex flex-col items-center text-sm"
                            wire:click="addBlock({{ $block['id'] }}, 'GREETINGS')"
                            >
                            <div class="flex-1 flex items-center justify-center w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                  </svg>
                            </div>

                            <div class="flex-none">
                                <span class="text-gray-700">Greetings</span>
                            </div>
                        </button>

                        <button
                            class="hover:border hover:border-blue-700 px-10 rounded transition duration-200 flex flex-col items-center text-sm"
                            wire:click="addBlock({{ $block['id'] }}, 'DIAL')">

                            <div class="flex-1 flex items-center justify-center w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-6" style="transform: rotate(45deg);">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 3.75v4.5m0-4.5h-4.5m4.5 0-6 6m3 12c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                                  </svg>
                            </div>

                            <div class="flex-none">
                                <span class="text-gray-700">Dial</span>
                            </div>
                        </button>
                        <button
                            class="hover:border hover:border-blue-700 hover:text-blue-700 px-10 rounded transition duration-200 flex flex-col items-center text-sm"
                            wire:click="addBlock({{ $block['id'] }}, 'SIMU')">

                            <div class="flex-1 flex items-center justify-center w-full">
                                <x-callflowicons.simucall></x-callflowicons.simucall>
                            </div>

                            <div class="flex-none">
                                <span class="text-gray-700">Simucall</span>
                            </div>
                        </button>
                        <button
                            class="hover:border hover:border-blue-700 px-10 rounded transition duration-200 flex flex-col items-center text-sm"
                            wire:click="addBlock({{ $block['id'] }}, 'ROUND')">

                            <div class="flex-1 flex items-center justify-center w-full">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z" clip-rule="evenodd"/>
                                  </svg>
                            </div>

                            <div class="flex-none">
                                Round Robin

                            </div>
                        </button>
                        <button
                            class="hover:border hover:border-blue-700 px-10 rounded transition duration-200 flex flex-col items-center text-sm"
                            wire:click="addBlock({{ $block['id'] }}, 'MENU')">

                            <div class="flex-1 flex items-center justify-center w-full">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z" clip-rule="evenodd"/>
                                  </svg>
                            </div>

                            <div class="flex-none">
                                <span class="text-gray-700">Menu</span>
                            </div>
                        </button>
                        <button
                            class="hover:border hover:border-blue-700 px-10 rounded transition duration-200 flex flex-col items-center text-sm"
                            wire:click="addBlock({{ $block['id'] }}, 'SCHEDULE')">

                            <div class="flex-1 flex items-center justify-center w-full" >
                                <x-callflowicons.schedule></x-callflowicons.schedule>
                            </div>

                            <div class="flex-none">
                                <span class="text-gray-700">Schedule</span>
                            </div>
                        </button>
                        <button
                            class="hover:border hover:border-blue-700 px-10 rounded transition duration-200 flex flex-col items-center text-sm"
                            wire:click="addBlock({{ $block['id'] }}, 'KEYPAD')">

                            <div class="flex-1 flex items-center justify-center w-full">

                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="black"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dialpad">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 3h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M18 3h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M11 3h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M4 10h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M18 10h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M11 10h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M11 17h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /></svg>
                            </div>

                            <div class="flex-none">
                                <span class="text-gray-700">Keypad Entry</span>
                            </div>
                        </button>
                        <button
                            class="hover:border hover:border-blue-700 px-10 rounded transition duration-200 flex flex-col items-center text-sm"
                            wire:click="addBlock({{ $block['id'] }}, 'TAG')">

                            <div class="flex-1 flex items-center justify-center w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="black" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                  </svg>
                            </div>

                            <div class="flex-none">
                                <span class="text-gray-700">Tag</span>
                            </div>
                        </button>
                        <button
                            class="hover:border hover:border-blue-700 px-10 rounded transition duration-200 flex flex-col items-center text-sm"
                            wire:click="addBlock({{ $block['id'] }}, 'VOICEMAIL')">

                            <div class="flex-1 flex items-center justify-center w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="black" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                              </svg>
                            </div>

                            <div class="flex-none">
                                <span class="text-gray-700">Voicemail</span>
                            </div>
                        </button>
                        <button
                            class="hover:border hover:border-blue-700 px-10 rounded transition duration-200 flex flex-col items-center text-sm"
                            wire:click="addBlock({{ $block['id'] }}, 'HANGUP')">
                            <div class="flex-1 flex items-center justify-center w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-6" style="transform: rotate(135deg);">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 3.75v4.5m0-4.5h-4.5m4.5 0-6 6m3 12c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                                </svg>
                            </div>

                            <div class="flex-none">
                                <span class="text-gray-700">Hangup</span>
                            </div>
                        </button>
                    </div>


                </div>
                <div class="flex justify-end">
                    <button
                        class="text-red-500 hover:underline"
                        wire:click="removeBlock({{ $block['id'] }})">
                        x Don't add this step
                    </button>
                </div>
            </div>
            @elseif($block['type'] == "GREETINGS")
            <div class="mb-8">
                <div class="p-4 border rounded shadow-sm bg-white w-full text-gray-800 text-left" id="block-{{ $block['id'] }}">
                    <div class="flex justify-between items-center">
                        <h4 class="font-bold text-lg">Greetings</h4>
                        <button class="text-red-500 hover:underline" wire:click="removeBlock({{ $block['id'] }})">x</button>
                    </div>
                    <div class="text-gray-500 text-sm">Play a message to the caller. Frequently used to notify the caller about call recording.</div>
                    <hr class="h-px my-4 bg-gray-200 border-0">
                    <div class="space-y-2 text-sm">
                        <p>Read the following text to the caller with a robot-like voice:</p>
                        <textarea class="w-full border border-gray-300 p-2 resize-none text-sm" placeholder="Type your message here..." wire:model="message">{{ $message }}</textarea>
                        <button class="flex items-center text-blue-600">
                            <x-atoms.icons.play class="mr-2"></x-atoms.icons.play>
                            Preview Message
                        </button>
                    </div>
                </div>
                <button class="my-4 px-4 py-2 text-blue-500 rounded hover:text-white hover:bg-blue-600" wire:click="chooseMenu('OPMENU', {{ $block['id'] + 1 }})">
                    + Insert Step Here
                </button>
            </div>
            @elseif($block['type'] == "DIAL")
            <div class="mb-"8>
                <div
                    class="p-4 border rounded shadow-sm bg-white w-full text-left space-y-4"
                    id="block-{{ $block['id'] }}">
                    <div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-lg">Dial </h4>
                            <button
                                class="text-red-500 hover:underline"
                                wire:click="removeBlock({{ $block['id'] }})">
                                x
                            </button>
                        </div>
                        <div class="text-gray-500 text-sm">This is where the phone will ring when customers dial your tracking number.</div>
                    </div>

                    <hr class="h-px my-4 bg-gray-200 border-0">

                    <span class="flex items-center space-x-2">
                        <div class="text-sm">Forward Calls To</div>
                        <div class="relative">
                            <input type="text" x-mask="999-999-9999" class="block px-2.5 text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Number
                            </label>
                        </div>
                    </span>

                    <div class="flex items-center">
                        <label class="ms-2 text-sm font-medium">
                        <input type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                            Prevent <span data-popover-target="popover-voicemails"
                                data-popover-placement="right"
                                class="text-blue-700 hover:text-blue-800 text-sm cursor-pointer">
                                voicemails and automated systems
                            </span> from answering a call.
                        </label>
                        <div role="tooltip"
                        class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 max-h-[300px] overflow-y-auto">
                            <div class="px-3 py-2">
                                <p>Some jurisdictions require both parties to consent to any recorded conversation. To assist in the compliance of these laws, you can enable a greeting to inform the caller that the call may be recorded. Your default greeting should disclose (1) that you are using CallRail to provide recording/transcription services and (2) disclose all purposes of the collection.</p>
                            </div>
                            <div data-popper-arrow></div>
                            <x-atoms.forms.button class="border">Close</x-atoms.forms.button>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 bg-blue-200 -mx-4 px-4 pt-2 text-blue-700">
                        <span>If the destination does not answer within</span>
                        <label class="block mb-2 text-sm text-gray-900 dark:text-white">
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 ">
                                <option value="5">5 Seconds</option>
                                <option value="10">10 Seconds</option>
                                <option value="20">20 Seconds</option>
                                <option value="30">30 Seconds</option>
                                <option value="60" selected>60 Seconds</option>
                            </select>
                        </label>
                        <span> then go to the next step.</span>
                    </div>
                </div>
                <div class="my-4 text-gray-500">
                    If call is not answered
                </div>
                <button
                    class="my-4 px-4 py-2 text-blue-500 rounded hover:text-white hover:bg-blue-600"
                    wire:click="chooseMenu('OPMENU', {{ $block['id'] + 1}})">
                    + Insert Step Here
                </button>
            </div>

            @elseif($block['type'] == "SIMU")
            <div class="mb-"8>
                <div
                    class="p-4 border rounded shadow-sm bg-white w-full text-left space-y-4"
                    id="block-{{ $block['id'] }}">
                    <div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-lg">Simulcall</h4>
                            <button
                                class="text-red-500 hover:underline"
                                wire:click="removeBlock({{ $block['id'] }})">
                                x
                            </button>
                        </div>
                        <div class="text-gray-500 text-sm">We'll dial all numbers in the Simulcall at the same time. The first person to answer will be connected to the caller.</div>
                    </div>

                    <hr class="h-px my-4 bg-gray-200 border-0">
                    <span class="flex flex-col space-y-2">
                        <div class="text-sm">Forward Calls To</div>

                        <div class="relative">
                            <input type="text" x-mask="999-999-9999" class="block px-2.5 text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Number
                            </label>
                        </div>
                        <div>
                            <button class="text-blue-700 text-sm">+ Add Number</button>
                        </div>
                    </span>
                    <div class="flex flex-col">
                        <div>
                            <label class="ms-2 text-sm font-medium">
                            <input type="checkbox" value=""
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                Prevent <span data-popover-target="popover-voicemails"
                                    data-popover-placement="right"
                                    class="text-blue-700 hover:text-blue-800 text-sm cursor-pointer">
                                    voicemails and automated systems
                                </span> from answering a call.
                            </label>
                            <div role="tooltip"
                            class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 max-h-[300px] overflow-y-auto">
                                <div class="px-3 py-2">
                                    <p>Some jurisdictions require both parties to consent to any recorded conversation. To assist in the compliance of these laws, you can enable a greeting to inform the caller that the call may be recorded. Your default greeting should disclose (1) that you are using CallRail to provide recording/transcription services and (2) disclose all purposes of the collection.</p>
                                </div>
                                <div data-popper-arrow></div>
                                <x-atoms.forms.button class="border">Close</x-atoms.forms.button>
                            </div>
                        </div>
                        <div>
                            <label class="ms-2 text-sm font-medium">
                            <input type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                Route previous callers to the number that answered last time they called.
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 bg-blue-200 -mx-4 px-4 pt-2 text-blue-700">
                        <span>If the destination does not answer within</span>
                        <label class="block mb-2 text-sm text-gray-900 dark:text-white">
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 ">
                                <option value="5">5 Seconds</option>
                                <option value="10">10 Seconds</option>
                                <option value="20">20 Seconds</option>
                                <option value="30">30 Seconds</option>
                                <option value="60" selected>60 Seconds</option>
                            </select>
                        </label>
                        <span> then go to the next step.</span>
                    </div>


                </div>
                <div class="my-4 text-gray-500">
                    If call is not answered
                </div>
                <button
                    class="my-4 px-4 py-2 text-blue-500 rounded hover:text-white hover:bg-blue-600"
                    wire:click="chooseMenu('OPMENU', {{ $block['id'] + 1}})">
                    + Insert Step Here
                </button>
            </div>
            @elseif($block['type'] == "ROUND")
            <div class="mb-"8>
                <div
                    class="p-4 border rounded shadow-sm bg-white w-full text-left space-y-4"
                    id="block-{{ $block['id'] }}">
                    <div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-lg">Round Robin</h4>
                            <button
                                class="text-red-500 hover:underline"
                                wire:click="removeBlock({{ $block['id'] }})">
                                x
                            </button>
                        </div>
                        <div class="text-gray-500 text-sm">Rotate calls evenly among a group of people. Repeat callers can be routed to the destination number that took the same caller's initial call.</div>
                    </div>

                    <hr class="h-px my-4 bg-gray-200 border-0">
                    <span class="flex flex-col space-y-2">
                        <div class="text-sm">Forward Calls To</div>

                        <div class="relative">
                            <input type="text" x-mask="999-999-9999" class="block px-2.5 text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Number
                            </label>
                        </div>
                        <div>
                            <button class="text-blue-700 text-sm">+ Add Number</button>
                        </div>
                    </span>
                    <div class="flex flex-col">
                        <div>
                            <label class="ms-2 text-sm font-medium">
                            <input type="checkbox" value=""
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                Prevent <span data-popover-target="popover-voicemails"
                                    data-popover-placement="right"
                                    class="text-blue-700 hover:text-blue-800 text-sm cursor-pointer">
                                    voicemails and automated systems
                                </span> from answering a call.
                            </label>
                            <div role="tooltip"
                            class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 max-h-[300px] overflow-y-auto">
                                <div class="px-3 py-2">
                                    <p>Some jurisdictions require both parties to consent to any recorded conversation. To assist in the compliance of these laws, you can enable a greeting to inform the caller that the call may be recorded. Your default greeting should disclose (1) that you are using CallRail to provide recording/transcription services and (2) disclose all purposes of the collection.</p>
                                </div>
                                <div data-popper-arrow></div>
                                <x-atoms.forms.button class="border">Close</x-atoms.forms.button>
                            </div>
                        </div>
                        <div>
                            <label class="ms-2 text-sm font-medium">
                            <input type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                Route calls using a weighted distribution.
                            </label>
                        </div>
                        <div>
                            <label  class="ms-2 text-sm font-medium">
                            <input type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                Route previous callers to the number that answered last time they called.
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 bg-blue-200 -mx-4 px-4 pt-2 text-blue-700">
                        <span>If no one answers,</span>
                        <label class="block mb-2 text-sm text-gray-900 dark:text-white">
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 ">
                                <option value="0">don't try any additional numbers</option>
                                <option value="1">try the next number</option>
                                <option value="2">try the next 2 numbers</option>
                                <option value="3">try the next 3 numbers</option>
                                <option value="4">try the next 4 numbers</option>
                                <option value="5">try the next 5 numbers</option>
                            </select>
                        </label>
                        <span>before continuing to the next step.</span>
                    </div>


                </div>
                <div class="my-4 text-gray-500">
                    If call is not answered
                </div>
                <button
                    class="my-4 px-4 py-2 text-blue-500 rounded hover:text-white hover:bg-blue-600"
                    wire:click="chooseMenu('OPMENU', {{ $block['id'] + 1}})">
                    + Insert Step Here
                </button>
            </div>
            @elseif($block['type'] == "MENU")
            <div class="mb-8">
                <div
                    class="p-4 border rounded shadow-sm bg-white w-full text-gray-800 text-left"
                    id="block-{{ $block['id'] }}">
                    <div class="flex justify-between items-center">
                        <h4 class="font-bold text-lg">Greetings</h4>
                        <button
                            class="text-red-500 hover:underline"
                            wire:click="removeBlock({{ $block['id'] }})">
                            x
                        </button>
                    </div>
                    <div class="text-gray-500 text-sm">Play a message to the caller. Frequently used to notify the caller about call recording.</div>
                    <hr class="h-px my-4 bg-gray-200 border-0">
                    <div class="space-y-2 text-sm">
                        <p>Read the following text to the caller with a robot-like voice:</p>
                        <textarea class="w-full border border-gray-300 p-2 resize-none text-sm" placeholder="Type your message here...">Press 1 for Sales, press 2 for Support.</textarea>
                        <button class="flex items-center text-blue-600">
                            <x-atoms.icons.play class="mr-2"></x-atoms.icons.play>
                            Preview Message
                        </button>
                    </div>
                    <div>
                        <div>If the caller</div>
                        <div class="flex flex-col space-y-4">
                            <div class="flex space-x-4">
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 ">
                                    @foreach($caller_pressed as $pressed)
                                    <option value="{{$pressed}}">Presses {{$pressed}}</option>
                                    @endforeach
                                    <option value="-1">Does nothing</option>
                                </select>
                                <input type="text" value="Forward to Sales">
                            </div>
                            <div class="flex space-x-4">
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 ">
                                    @foreach($caller_pressed as $pressed)
                                    <option value="{{$pressed}}">Presses {{$pressed}}</option>
                                    @endforeach
                                    <option value="-1">Does nothing</option>
                                </select>
                                <input type="text" value="Forward to Support">
                            </div>
                        </div>
                        <div>
                            <button class="text-blue-700 text-sm">+ Add Number</button>
                        </div>
                    </div>
                </div>
                <div class="my-4 text-gray-500">
                    The caller pressed ‘1’
                </div>
                    <button
                        class="my-4 px-4 py-2 text-blue-500 rounded hover:text-white hover:bg-blue-600"
                        wire:click="chooseMenu('OPMENU', {{ $block['id'] + 1}})">
                        + Insert Step Here
                    </button>
            </div>
            @elseif($block['type'] == "SCHEDULE")
            <div class="mb-"8>
                <div
                    class="p-4 border rounded shadow-sm bg-white w-full text-left space-y-4"
                    id="block-{{ $block['id'] }}">
                    <div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-lg">Schedule</h4>
                            <button
                                class="text-red-500 hover:underline"
                                wire:click="removeBlock({{ $block['id'] }})">
                                x
                            </button>
                        </div>
                        <div class="text-gray-500 text-sm">Create a schedule that determines how your calls should be routed.</div>
                        <div class="text-gray-300 text-sm">Time Zone: America/Indiana/Knox</div>
                    </div>

                    <hr class="h-px my-4 bg-gray-200 border-0">
                    <div class="flex items-center space-x-2 bg-blue-200 -mx-4 px-4 pt-2 text-blue-700">
                        <span><span class="font-semibold">Schedule Branch A:</span> If a call is received during the following times</span>

                    </div>

                    <div class="flex space-x-4">
                        <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 ">
                            @foreach($days as $day)
                            <option value="{{$day}}">{{$day}}</option>
                            @endforeach
                        </select>
                        <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 ">
                            @foreach($times as $time)
                            <option value="{{$time}}">{{$time}}</option>
                            @endforeach
                        </select>
                        <div>
                            <span>From: </span>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500">
                                @for ($hour = 0; $hour < 24; $hour++)
                                    @php
                                        // Determine if it's AM or PM
                                        $ampm = $hour < 12 ? 'AM' : 'PM';
                                        // Convert to 12-hour format
                                        $displayHour = $hour % 12 === 0 ? 12 : $hour % 12;
                                    @endphp
                                    <option value="{{ $hour }}">{{ $displayHour }} {{ $ampm }}</option>
                                @endfor
                            </select>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500">
                                @for ($minute = 0; $minute < 60; $minute += 5)
                                    <option value="{{ $minute }}">{{ str_pad($minute, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <span>
                                To:
                            </span>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500">
                                @for ($hour = 0; $hour < 24; $hour++)
                                    @php
                                        // Determine if it's AM or PM
                                        $ampm = $hour < 12 ? 'AM' : 'PM';
                                        // Convert to 12-hour format
                                        $displayHour = $hour % 12 === 0 ? 12 : $hour % 12;
                                    @endphp
                                    @if($ampm == 'PM' && $displayHour == 11)
                                        <option value="{{ $hour }}" selected>{{ $displayHour ." ". $ampm }}</option>
                                    @else
                                        <option value="{{ $hour }}">{{ $displayHour ." ". $ampm }}</option>
                                    @endif

                                @endfor
                            </select>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500">
                                @for ($minute = 0; $minute < 60; $minute += 5)
                                    <option value="{{ $minute }}">{{ str_pad($minute, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>

                    </div>

                    <div>
                        <button class="text-blue-700 text-sm">+ Add Number</button>
                    </div>
                    <x-atoms.forms.button variant="primary">+ Add Schedule Branch</x-atoms.forms.button>

                    <div>
                        Any other time.
                    </div>
                </div>
                <div class="my-4 text-gray-500">
                    The call is received during Schedule Branch A
                </div>
                    <button
                        class="my-4 px-4 py-2 text-blue-500 rounded hover:text-white hover:bg-blue-600"
                        wire:click="chooseMenu('OPMENU', {{ $block['id'] + 1}})">
                        + Insert Step Here
                    </button>
            </div>
            @elseif($block['type'] == "KEYPAD")
            <div class="mb-"8>
                <div
                    class="p-4 border rounded shadow-sm bg-white w-full text-left space-y-4"
                    id="block-{{ $block['id'] }}">
                    <div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-lg">Keypad Entry</h4>
                            <button
                                class="text-red-500 hover:underline"
                                wire:click="removeBlock({{ $block['id'] }})">
                                x
                            </button>
                        </div>
                        <div class="text-gray-500 text-sm">
                            Prompt your callers to enter a code. This can be a PIN, account number, or any numeric identifier that includes up to 15 digits. The code they enter shows in Lead Center and on their timeline.
                        </div>
                    </div>

                    <hr class="h-px my-4 bg-gray-200 border-0">

                    <div class="space-y-2 text-sm">
                        <p>Read the following text to the caller with a robot-like voice:</p>
                        <textarea class="w-full border border-gray-300 p-2 resize-none text-sm" placeholder="Type your message here...">Thank you for your call. Please leave a message.</textarea>
                        <button class="flex items-center text-blue-600">
                            <x-atoms.icons.play class="mr-2"></x-atoms.icons.play>
                            Preview Message
                        </button>
                        <div>
                            <input type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label class="ms-2 text-sm font-medium">
                                Allow caller to press # and skip entering a code.
                            </label>
                        </div>
                    </div>



                </div>
                    <button
                        class="my-4 px-4 py-2 text-blue-500 rounded hover:text-white hover:bg-blue-600"
                        wire:click="chooseMenu('OPMENU', {{ $block['id'] + 1}})">
                        + Insert Step Here
                    </button>
            </div>
            @elseif($block['type'] == "TAG")
            <div class="mb-"8>
                <div
                    class="p-4 border rounded shadow-sm bg-white w-full text-left space-y-4"
                    id="block-{{ $block['id'] }}">
                    <div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-lg">Tag</h4>
                            <button
                                class="text-red-500 hover:underline"
                                wire:click="removeBlock({{ $block['id'] }})">
                                x
                            </button>
                        </div>
                        <div class="text-gray-500 text-sm">Add one or more tags to the call.</div>
                    </div>

                    <hr class="h-px my-4 bg-gray-200 border-0">
                    <span class="flex items-center space-x-2">
                        + Button where we search from all previous
                    </span>



                </div>
                    <button
                        class="my-4 px-4 py-2 text-blue-500 rounded hover:text-white hover:bg-blue-600"
                        wire:click="chooseMenu('OPMENU', {{ $block['id'] + 1}})">
                        + Insert Step Here
                    </button>
            </div>
            @elseif($block['type'] == "VOICEMAIL")
            <div class="mb-"8>
                <div
                    class="p-4 border rounded shadow-sm bg-white w-full text-left space-y-4"
                    id="block-{{ $block['id'] }}">
                    <div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-lg">Voicemail</h4>
                            <button
                                class="text-red-500 hover:underline"
                                wire:click="removeBlock({{ $block['id'] }})">
                                x
                            </button>
                        </div>

                    </div>

                    <hr class="h-px my-4 bg-gray-200 border-0">
                    <div class="space-y-2 text-sm">
                        <p>Read the following text to the caller with a robot-like voice:</p>
                        <textarea class="w-full border border-gray-300 p-2 resize-none text-sm" placeholder="Type your message here...">Thank you for your call. Please leave a message.</textarea>
                        <button class="flex items-center text-blue-600">
                            <x-atoms.icons.play class="mr-2"></x-atoms.icons.play>
                            Preview Message
                        </button>
                    </div>



                </div>
            </div>
            @elseif($block['type'] == "HANGUP")
            <div class="mb-"8>
                <div
                    class="p-4 border rounded shadow-sm bg-white w-full text-left space-y-4"
                    id="block-{{ $block['id'] }}">
                    <div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-lg">Hang Up</h4>
                            <button
                                class="text-red-500 hover:underline"
                                wire:click="removeBlock({{ $block['id'] }})">
                                x
                            </button>
                        </div>
                        <div class="text-gray-500 text-sm">The call will be disconnected.</div>
                    </div>
                </div>

            </div>
            @endif

        @endforeach
    </div>
</div>
