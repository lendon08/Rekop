<div class="px-4">
    <div class="{{ $insertoptions ? '' : 'hidden' }}">
        <x-organisms.table>
            <x-molecules.tables.thead>
                <tr class="bg-white">
                    <x-atoms.tables.th>Swap Target</x-atoms.tables.th>
                    <x-atoms.tables.th>Tracking Sources</x-atoms.tables.th>
                </tr>
            </x-molecules.tables.thead>
            <x-molecules.tables.tbody class="font-semibold">
                <tr>
                    <x-atoms.tables.td>{{ $phone->tracking->swaptarget }}</x-atoms.tables.td>
                    <x-atoms.tables.td>{{ $phone->tracking->tracking_options }}</x-atoms.tables.td>
                </tr>
            </x-molecules.tables.tbody>
        </x-organisms.table>

    </div>

    <div class="flex {{ !$insertoptions ? '' : 'hidden' }}">
        <section class="w-3/5 flex flex-col bg-white px-4 py-4 space-y-4">
            <div class="flex-grow mb-4">
                <span class="font-bold">Swap Target</span>
                <div class="text-justify mb-2">
                  <input type="text" x-mask="(999) 999-9999" wire:model="swaptarget" class="rounded">
                </div>
                <div class="text-gray-600">Please contact your admin to add another swap target.</div>
            </div>
            <div class="flex-grow mb-4">
                <span class="font-bold">Tracking Sources</span>
                <div class="text-justify mb-2 space-y-4">
                  <div class="flex items-center">
                    <label class="font-semibold w-48"> Search</label>
                    <input type="radio" class="mr-2" wire:model.live="trackingoptions" value="Search">
                    Visitors from
                    <select class="mx-2 rounded {{ $trackingoptions != "Search" ? 'cursor-not-allowed' : '' }}"
                    @disabled( $trackingoptions != "Search")
                    >
                        @foreach (App\Enums\TrackingSearchEngine::cases() as $search)
                                <option value="{{$search->value }}">{{ $search->value }}</option>
                        @endforeach
                    </select>
                    for
                    <select class="mx-2 rounded {{ $trackingoptions != "Search" ? 'cursor-not-allowed' : '' }}"
                    @disabled( $trackingoptions != "Search")
                    >
                        @foreach (App\Enums\TrackingTraffic::cases() as $traffic)
                            <option value="{{$traffic->value }}">{{ $traffic->value }}</option>
                        @endforeach
                    </select>
                    search</div>
                <div class="flex items-center">
                    <label class="font-semibold w-48"> Web Referalls</label>
                    <input type="radio" class="mr-2" wire:model.live="trackingoptions" value="Web Referrals"> Visitors from
                    <input type="text" placeholder="yelp.com"
                    class="ml-2 rounded {{ $trackingoptions != "Web Referrals" ? 'cursor-not-allowed' : '' }}"
                    @disabled( $trackingoptions != "Web Referrals")
                    >
                </div>
                <div class="flex items-center">
                    <label class="font-semibold w-48"> Landing Page</label>
                    <input type="radio" class="mr-2" wire:model.live="trackingoptions" value="Landing Page"> Visitors who land on
                    <input type="text" placeholder="landingpage.com"
                    class="ml-2 rounded {{ $trackingoptions != "Landing Page" ? 'cursor-not-allowed' : '' }}"
                    @disabled( $trackingoptions != "Landing Page")
                    >
                </div>
                <div class="flex items-center">
                    <label class="font-semibold w-48"> Landing Params</label>
                    <input type="radio" class="mr-2" wire:model.live="trackingoptions" value="Landing Params"> Visitors to a landing page containing
                    <input type="text" placeholder="utm_source=example"
                    class="ml-2 rounded {{ $trackingoptions != "Landing Params" ? 'cursor-not-allowed' : '' }}"
                    @disabled( $trackingoptions != "Landing Params")
                    >
                </div>
                <div class="flex items-center">
                    <label class="font-semibold w-48"> Direct</label>
                    <input type="radio" class="mr-2" wire:model.live="trackingoptions" value="Direct"> Visitors without a referring website

                </div>
                <div class="flex items-center">
                    <label class="font-semibold w-48"> Other</label>
                    <input type="radio" class="mr-2" wire:model.live="trackingoptions" value="Other"> No dynamic number swapping

                    </div>
                <div class="flex items-center">
                    <label class="font-semibold w-48"> Always Swap</label>
                    <input type="radio" class="mr-2" wire:model.live="trackingoptions" value="All Visitors">Show the tracking number to all visitors, regardless of source.
                </div>
                </div>
                <div class="mt-auto flex ">
                    <div class="place-content-end">
                        <x-atoms.forms.button variant="primary">Save</x-atoms.forms.button>
                        <x-atoms.forms.button wire:click.prevent="closeInsert('insertionoption')">Cancel</x-atoms.forms.button>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-2/5 bg-gray-100 px-4 py-4">
            <div class="mb-4">
                <span class="font-semibold text-sm">Swap Target</span>
                <div class="text-justify">The swap target is the number you want us to replace with a tracking number from your pool. Usually, this is your main business number.</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold text-sm">Tracking Sources</span>
                <div class="text-justify">Choose which visitors you want to track. These are the only visitors who will see tracking numbers. We recommend tracking everyone, but you can also select specific groups.</div>
            </div>
        </section>
    </div>

</div>
