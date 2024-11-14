<div class="px-4">
    <div class="{{$advanceoptions ? '':'hidden'}}">
        <x-organisms.table>
            <x-molecules.tables.thead>
                <tr class="bg-white">

                    <x-atoms.tables.th>Text Messaging</x-atoms.tables.th>
                    <x-atoms.tables.th>Google Analytics</x-atoms.tables.th>
                    <x-atoms.tables.th>Caller ID</x-atoms.tables.th>
                </tr>
            </x-molecules.tables.thead>
            <x-molecules.tables.tbody class="font-semibold">
                <x-atoms.tables.td>On</x-atoms.tables.td>
                <x-atoms.tables.td>Automatically set the source, medium, and campaign.</x-atoms.tables.td>
                <x-atoms.tables.td>Caller's Number</x-atoms.tables.td>


            </x-molecules.tables.tbody>
        </x-organisms.table>
    </div>

    <div class="flex {{!$advanceoptions ? '':'hidden'}}">
        <section class="w-3/5 flex flex-col bg-white px-4 py-4">
            <div class="flex-grow mb-4">
                <span class="font-semibold">Text Messaging</span>
                <div class="text-justify mb-2">
                    <input type="checkbox" wire:model="textmsg" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 ">
                    <span class="ml-2">Receive text messages (SMS) on my tracking number.</span></label>
                </div>
            </div>
            <div class="flex-grow mb-4">
                <span class="font-semibold">Google Analytics</span>
                <div class="text-justify mb-2 space-y-4">
                    <div>
                        <label class="mb-4">
                            <input type="radio" wire:model.live="analytics" value="auto">
                            <span class="ml-2">Automatically set the source, medium, and campaign.</span>
                        </label>
                        <div class="mt-4 {{ $analytics != "auto" ? 'hidden' : '' }}">
                            <div class="ml-4"><span class="font-semibold">utm_source:</span> {{ $utm_source }}</div>
                            <div class="ml-4"><span class="font-semibold">utm_medium:</span> {{ $utm_medium }}</div>
                            <div class="ml-4"><span class="font-semibold">utm_campaign:</span> {{ $utm_campaign }}  </div>
                        </div>
                    </div>
                    <div >
                        <label>
                            <input type="radio" wire:model.live="analytics" value="custom">
                            <span class="ml-2">Let me set the source, medium, and campaign.</span>
                        </label>
                        <div class="pt-4 {{ $analytics != "custom" ? 'hidden' : '' }}">
                            <div class="ml-4 mb-4">
                                <label for="utm_source" class="block font-semibold">utm_source</label>
                                <input type="text" class="rounded" wire.model=>
                                <span data-popover-target="popover-source" class="text-blue-700 hover:text-blue-800 text-sm cursor-pointer">What is source?</span>

                                <div data-popover id="popover-source" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div class="px-3 py-2 font-semibold">
                                        <p>The advertiser, site, or publication that is sending traffic to your website. </p>
                                        <p>Example. Google, bing, referrer, direct</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </div>
                            <div class="ml-4 mb-4">
                                <label for="utm_medium" class="block font-semibold">utm_medium</label>
                                <input type="text" class="rounded" id="utm_medium">
                                <span data-popover-target="popover-medium" class="text-blue-700 hover:text-blue-800 text-sm cursor-pointer">What is medium?</span>

                                <div data-popover id="popover-medium" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-smtransition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div class="px-3 py-2 font-semibold">
                                        <p>The advertiser medium or marketing channel that drove the phone call.</p>
                                        <p>Example cpc, organic, banner, facebook, twitter, email, retarget</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </div>
                            <div class="ml-4 mb-4">
                                <label for="utm_campaign" class="block font-semibold">utm_campaign</label>
                                <input type="text" class="rounded" id="utm_campaign">
                                <span data-popover-target="popover-campaign" class="text-blue-700 hover:text-blue-800 text-sm cursor-pointer">What is campaign?</span>

                                <div data-popover id="popover-campaign" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div class="px-3 py-2">
                                        <p>The individual campaign name, slogan, or promo code for a single marketing campaign.</p>
                                        <p>Example: March Newsletter, 300x200 Banner Ad 2, Facebook Holiday Promo</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div>
                        <label>
                            <input type="radio" wire:model.live="analytics" value="no">
                            <span class="ml-2">Don't send these calls to Google Analytics.</span>
                        </label>
                    </div>
                </div>

            </div>
            <div class="flex-grow mb-4">
                <span class="font-semibold">Caller ID Options</span>
                <div class="text-justify mb-2">
                    <span class="text-gray-500">Select a number to appear on the caller ID when calls are routed to you.</span>
                    <div>
                        <select class="rounded" wire:model="callerid">
                            <option value="caller">Caller's number</option>
                            <option value="tracking">Tracking number</option>
                            <option value="universal">CallRail's universal number</option>
                            <option value="specific">Specfic Number</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-auto flex ">
                <div class="place-content-end">
                    <x-atoms.forms.button wire:click.prevent="save" variant="primary">Save</x-atoms.forms.button>
                    <x-atoms.forms.button wire:click.prevent="closeAdvance('advanceoptions')">Cancel</x-atoms.forms.button>
                </div>
            </div>
        </section>
        <section class="w-2/5 bg-gray-100 px-4 py-4">
            <div class="mb-4">
                <span class="font-semibold text-sm">Text Messaging</span>
                <div class="text-justify">With this feature, customers can send texts to numbers in your website pool as if they were mobile phones. Texting is only available for local tracking numbers.</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold text-sm">Google Analytics</span>
                <div class="text-justify">Choose whether or not to report to Google Analytics for this number. If you wish to use it, you can define custom values or let us automatically send the best medium, source, and campaign.</div>
            </div>
        </section>
    </div>


</div>
