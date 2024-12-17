<div class="px-4">

        <div class="{{$numberOptions ? '': 'hidden'}}">

            <x-organisms.table>
                <x-molecules.tables.thead>
                    <tr class="bg-white">
                        <x-atoms.tables.th> Number Name</x-atoms.tables.th>
                        <x-atoms.tables.th>Forward Calls To</x-atoms.tables.th>
                        <x-atoms.tables.th>Call Recording</x-atoms.tables.th>
                        <x-atoms.tables.th>Call Greetings</x-atoms.tables.th>
                        <x-atoms.tables.th>Whisper Message</x-atoms.tables.th>
                        <x-atoms.tables.th>Auto Reply</x-atoms.tables.th>
                    </tr>
                </x-molecules.tables.thead>
                <x-molecules.tables.tbody class="font-semibold">
                    <x-atoms.tables.td>{{ $name }}</x-atoms.tables.td>
                    <x-atoms.tables.td>{{  \App\Services\PhoneFormatService::formatNoCountryCode($number) }}</x-atoms.tables.td>
                    <x-atoms.tables.td>{{ $recordingF ? "On" : "Off" }}</x-atoms.tables.td>
                    <x-atoms.tables.td>{{ $callgreetingF? "On" : "Off" }}</x-atoms.tables.td>
                    <x-atoms.tables.td>{{ $whisperF? "On" : "Off" }}</x-atoms.tables.td>
                    <x-atoms.tables.td>{{ $autoreply? "On" : "Off" }}</x-atoms.tables.td>
                </x-molecules.tables.tbody>
            </x-organisms.table>
        </div>

        <div class="flex {{ !$numberOptions ? '': 'hidden'}}">
            <section class="w-3/5 flex flex-col bg-white px-4 py-4 space-y-4" >
                <div class="flex-grow mb-4">
                    <span class="font-semibold">Number Name</span>
                    <div class="text-justify">
                      <input type="text" class="rounded" wire:model="name">

                    </div>
                </div>
                <div class="flex-grow mb-4">
                    <span class="font-semibold">Number</span>
                    <div class="text-justify">
                      <input type="text" x-mask="999-999-9999" class="rounded" wire:model="number" disabled >
                    </div>
                </div>
                <div class="flex-grow mb-4">
                    <span class="font-semibold">Whisper Message</span>
                    <div class="text-justify">
                      <div>

                        <input type="checkbox" wire:model.live="whisperF" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 ">
                        <span class="pl-2">
                            <input type="text"
                            wire:model = "whisper"
                            class="rounded {{ $whisperF  ?  '' : 'cursor-not-allowed' }}"
                            @disabled(!$whisperF)>
                        </span>
                    </div>
                        <div class="flex items-center {{ $whisperF ? '' : 'hidden'}}" >
                            <button type="button" class="flex items-center">
                                <x-atoms.icons.play class="w-5 h-5 mr-2 text-blue-500" /> Preview Message
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex-grow mb-4">
                    <span class="font-semibold mb-2">Forward Calls To</span>
                    <div class="text-justify space-y-4">
                      <div class="text-gray-400">Enter the number that you want your calls forwarded to.</div>
                      <div><input type="text" x-mask="999-999-9999" class="rounded" wire:model="swaptarget"></div>
                    </div>
                </div>

                <div class="flex-grow mb-4">
                    <span class="font-semibold">Call Recording</span>
                    <div class="text-justify">
                        <label class="cursor-pointer">
                            <input type="checkbox"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked>
                            Enable call recording
                         </label>
                        <span data-popover-target="popover-legal-note" class="text-blue-700 hover:text-blue-800 text-sm cursor-pointer">Legal Note</span>

                        <div data-popover id="popover-legal-note" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">

                            <div class="px-3 py-2">
                                <p>Some jurisdictions require both parties to consent to any recorded conversation. To assist in the compliance of these laws, you can enable a greeting to inform the caller that the call may be recorded. Your default greeting should disclose (1) that you are using CallRail to provide recording/transcription services and (2) disclose all purposes of the collection.</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>

                    </div>
                </div>
                <div class="flex-grow mb-4">
                    <span class="font-semibold">Call Greeting</span>
                    <div class="text-justify space-y-4">
                        <label class="cursor-pointer">
                            <input type="checkbox" wire:model.live="callgreetingF" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 ">
                            Play a greeting to the caller.
                         </label>

                        <div class="space-y-4 {{ $callgreetingF ? '': 'hidden'}}">

                            <span class="text-gray-400">Read the following text to the caller with a robot-like voice:</span>

                            <div>
                                <textarea class="min-h-[50px] rounded resize-y" cols="50" wire:model="callgreeting"></textarea>

                            </div>
                            <div class="flex items-center">
                                <button type="button" class="flex items-center">
                                    <x-atoms.icons.play class="w-5 h-5 mr-2 text-blue-500" /> Preview Message
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-grow mb-4">
                    <span class="font-semibold mb-2">Campaign Name</span>
                    <div class="text-justify space-y-4">

                      <div><input type="text" class="rounded" wire:model="campaign" placeholder="New Campaign"></div>
                    </div>
                </div>
                <div class="flex-grow mb-4">
                    <span class="font-semibold">Auto reply to text messages</span>
                    <div class="text-justify">
                        <label class="cursor-pointer">
                            <input type="checkbox" wire:model="autoreply" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 ">
                            Enable auto reply
                         </label>
                         <span data-popover-target="popover-auto-reply" class="text-blue-700 hover:text-blue-800 text-sm cursor-pointer">Info icon</span>

                        <div data-popover id="popover-auto-reply" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            <div class="px-3 py-2">
                                <p>In order to use auto reply, your business must be registered to send texts through the Campaign Registry.</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>
                </div>
                <div class="mt-auto flex ">
                    <div class="place-content-end">
                        <x-atoms.forms.button wire:click.prevent="NumberOptionSave" variant="primary">Save</x-atoms.forms.button>
                        <x-atoms.forms.button wire:click.prevent="closeNumber('numberOptions')">Cancel</x-atoms.forms.button>
                    </div>
                </div>
            </section>
            <section class="w-2/5 bg-gray-100 px-4 py-4">
                <div class="mb-4">
                    <span class="font-semibold text-sm">Number Name</span>
                    <div class="text-justify">This is the name assigned to this specific number in reports. Choose whatever you want, but something brief and easy to remember is best. Example: 15th Street Store.</div>
                </div>
                <div class="mb-4">
                    <span class="font-semibold text-sm">Call Destination</span>
                    <div class="text-justify">This is the number where your calls will be forwarded. You can use your main business line, your personal line, or any other existing phone number you own.
                        <div class="mt-2">You can also create a custom call flow to route calls within your organization</div>
                    </div>
                </div>
                <div class="mb-4">
                    <span class="font-semibold text-sm">Whisper Message</span>
                    <div class="text-justify">A "Whisper Message" is a short recording that plays to the recipient before a forwarded call is connected. It's a good way for the recipient to know where the call is coming from. The caller cannot hear this message.</div>
                </div>
                <div class="mb-4">
                    <span class="font-semibold text-sm">Call Recording</span>
                    <div class="text-justify">You can record incoming phone calls and replay them from your CallRail dashboard.</div>
                </div>
                <div class="mb-4">
                    <span class="font-semibold text-sm">Call Greeting</span>
                    <div class="text-justify">Greetings are messages that the caller hears at the beginning of the call. You can upload an audio file or type a message that's read by a text-to-speech tool.</div>
                </div>
                <div class="mb-4">
                    <span class="font-semibold text-sm">Campaign Name</span>
                    <div class="text-justify">This name displays in the “Campaign" column of your call log and can be used as a filter for your reports.</div>
                </div>
                <div class="mb-4">
                    <span class="font-semibold text-sm">Auto Reply</span>
                    <div class="text-justify">You can automatically reply to leads who text your tracking numbers using an auto reply. An auto reply will only be sent to a lead once in a 24-hour period, so if they send multiple text messages back to back, they’ll only receive the auto reply once. The first time we auto reply to a lead, we will automatically include opt out instructions if none were included in the message. In order to use auto reply, your business must be registered to send texts through the Campaign Registry.</div>
                </div>

            </section>

        </div>


</div>
