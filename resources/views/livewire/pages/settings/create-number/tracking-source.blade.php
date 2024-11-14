<div class="{{ $pageCnt == 4 ? '' : 'hidden' }} text-left font-medium">

    <div class="space-y-4 mb-4">
        <p class="mb-5 text-2xl sm:text-2xl font-semibold">Tracking Source</p>
        <hr class="h-px my-8 bg-gray-200 border-0">
        <div class="">
            <p class="text-xl ">Which visitors do you want to track?</p>
            <p class="text-lg text-gray-500">Pick one- you can always change this later.</p>
        </div>
    </div>

    <div class="space-y-4 text-base">
        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.blur="trackingOption" aria-describedby="all-visitors" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                  Always Visitors
                    <p id="all-visitors" class="{{ $trackingOption==0 ? '' : 'hidden' }} text-gray-500">
                        Show the tracking number to all visitors, regardless of source.
                    </p>
            </div>
        </div>


        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.blur="trackingOption" aria-describedby="search" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                Search
                <p id="search" class="text-gray-500
                    {{ $trackingOption != 1 ?  'hidden': '' }}">

                    Visitors from
                    <select >
                        @foreach (App\Enums\TrackingSearchEngine::cases() as $search)
                                <option value="{{$search->value }}">{{ $search->value }}</option>
                        @endforeach
                    </select>
                    for
                    <select >
                        @foreach (App\Enums\TrackingTraffic::cases() as $traffic)
                            <option value="{{$traffic->value }}">{{ $traffic->value }}</option>
                        @endforeach
                    </select>
                    search
                </p>
            </div>
        </div>
        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.blur="trackingOption" aria-describedby="web-referrals" type="radio" value="2" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                Web referrals
                <p id="landing-page" class="{{ $trackingOption==2 ? '' : 'hidden' }} text-gray-500">Visitors from
                    <input placeholder="yelp.com" type="text"></p>
            </div>
        </div>

        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.blur="trackingOption" aria-describedby="landing-page" type="radio" value="3" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                Landing Page
                <p id="landing-page" class="{{ $trackingOption==3 ? '' : 'hidden' }} text-gray-500">Visitors who land on
                    <input placeholder="xyz.com" type="text"></p>
            </div>
        </div>
        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.blur="trackingOption" aria-describedby="landing-campaign" type="radio" value="4" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                Landing Params
                <p id="landing-campaign" class="{{ $trackingOption==4 ? '' : 'hidden' }} text-gray-500">Visitors to a landing page containing
                    <input placeholder="utm_campaign=xyz" type="text"></p>
            </div>
        </div>

        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.blur="trackingOption" aria-describedby="direct" type="radio" value="5" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                Direct
                <p id="direct" class="{{ $trackingOption==5 ? '' : 'hidden' }} text-gray-500">Visitors without a referring website
            </div>
        </div>
    </div>

    <div class="py-4 mt-4 space-y-2">
        <p class="text-lg sm:text-xl">Swap target</p>

        <p class="text-gray-500">
            This is the phone number we look for on your website to dynamically replace with a tracking number. <br>
            Typically, this is the primary business phone number or the destination number.</p>
        <input x-mask="999-999-9999" placeholder="555-555-5555" type="tel" wire:model.blur="swapTarget">
    </div>

</div>
