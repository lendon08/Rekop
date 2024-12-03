<div class="{{ $pageCnt == 4 ? '' : 'hidden' }} text-left font-medium">

    <div class="space-y-4 mb-4">
        <p class="mb-5 text-2xl sm:text-2xl font-semibold">Tracking Option</p>
        <hr class="h-px my-8 bg-gray-200 border-0">
        <div class="">
            <p class="text-xl ">Which visitors do you want to track?</p>
            <p class="text-lg text-gray-500">Pick one- you can always change this later.</p>
        </div>
    </div>

    <div class="space-y-4 text-base">
        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.live="trackingOption" aria-describedby="all-visitors" type="radio" value="All Visitors" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                <p>All visitors regardless of source</p>
                <div id="all-visitors" class="{{ $trackingOption=="All Visitors" ? '' : 'hidden' }} text-gray-500">
                    Show the same tracking number to every visitor to keep a record of calls without a specific source information.
                </div>
            </div>
        </div>



        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.live="trackingOption" aria-describedby="search" type="radio" value="Search" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                <p>Search</p>
                <p id="search" class="text-gray-500
                    {{ $trackingOption != "Search" ?  'hidden': '' }}">

                    Visitors from
                    <select class='rounded' wire:model='searchengine'>
                        @foreach (App\Enums\TrackingSearchEngine::cases() as $search)
                                <option value="{{$search->value }}">{{ $search->value }}</option>
                        @endforeach
                    </select>
                    for
                    <select class='rounded' wire:model='traffic'>
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
                <input wire:model.live="trackingOption" aria-describedby="web-referrals" type="radio" value="Web Referrals" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                <p>Web referrals</p>
                <div id="landing-page" class="{{ $trackingOption=="Web Referrals" ? '' : 'hidden' }} text-gray-500">Visitors from
                    <input placeholder="yelp.com" type="text" class="rounded" wire:model>

                    <span data-popover-target="popover-url-tip" class="text-blue-700 hover:text-blue-800 text-sm cursor-pointer">What kind of URL should i use?</span>

                    <div data-popover id="popover-url-tip" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">

                        <div class="px-3 py-2">
                            <p>Web Referrals URLs must use an exact domain name without any forward slashes.</p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.live="trackingOption" aria-describedby="landing-page" type="radio" value="Landing Page" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                <p>Landing Page</p>
                <div id="landing-page" class="{{ $trackingOption=='Landing Page' ? '' : 'hidden' }} text-gray-500">Visitors who land on
                    <input placeholder="xyz.com" type="text" class="rounded">
                </div>
            </div>
        </div>
        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.live="trackingOption" aria-describedby="landing-params" type="radio" value="Landing Params" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                <p>Landing Params</p>
                <div id="landing-campaign" class="{{ $trackingOption=='Landing Params' ? '' : 'hidden' }} text-gray-500">Visitors to a landing page containing
                    <input placeholder="utm_campaign=xyz" type="text" class="rounded">
                </div>
            </div>
        </div>

        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.live="trackingOption" aria-describedby="direct" type="radio" value="Direct" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div class="text-gray-900 text-lg">
                <p>Direct</p>
                <p id="direct" class="{{ $trackingOption=='Direct' ? '' : 'hidden' }} text-gray-500">Visitors without a referring website
            </div>
        </div>
    </div>

    <div class="py-4 mt-4 space-y-2">
        <p class="text-lg sm:text-xl">Swap target</p>

        <p class="text-gray-500">
            This is the phone number we look for on your website to dynamically replace with a tracking number. <br>
            Typically, this is the primary business phone number or the destination number.</p>
        <input x-mask="999-999-9999" placeholder="555-555-5555" type="tel" wire:model="swapTarget" class="rounded">
    </div>

</div>
