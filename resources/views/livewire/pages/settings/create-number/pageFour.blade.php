<div class="{{ $pageCnt == 4 ? '' : 'hidden' }} text-left">

    <div class="space-y-4 mb-4">
        <p class="mb-5 text-2xl sm:text-2xl font-semibold">Tracking Options</p>
        <hr class="h-px my-8 bg-gray-200 border-0">
        <div class="font-medium">
            <p class="text-xl sm:text-xl">Which visitors do you want to track?</p>
            <p class="text-xs font-normal text-gray-500">Pick one- you can always change this later.</p>
        </div>
    </div>

    <div class="space-y-4 text-base">
        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.live="trackingOption" aria-describedby="all-visitors" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div>
                <label for="all-visitors" class="font-medium text-gray-900"> All visitors (Recommended)</label>
            </div>
        </div>

        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.live="trackingOption" aria-describedby="google-ads" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div>
                <label for="google-ads" class="font-medium text-gray-900">Visitors from Google Ads</label>
            </div>

        </div>

        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.live="trackingOption" aria-describedby="ppc-search" type="radio" value="2" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div>
                <label for="helper-radio" class="font-medium text-gray-900">PPC search</label>
                <p id="ppc-search" class="{{ $trackingOption==2 ? '' : 'hidden' }} text-xs font-normal text-gray-500">Visitors from Google, Bing and Yahoo PPC search.</p>
            </div>
        </div>

        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.live="trackingOption" aria-describedby="landing-page" type="radio" value="3" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div>
                <label for="helper-radio" class="font-medium text-gray-900">Landing Page or URL parameter</label>
                <p id="landing-page" class="{{ $trackingOption==3 ? '' : 'hidden' }} text-xs font-normal text-gray-500">Visitors who land on. <input placeholder="xyz.com or utm_campaign=xyz" type="text"></p>

            </div>
        </div>

        <div class="flex space-x-2">
            <div class="flex items-center h-5">
                <input wire:model.live="trackingOption" aria-describedby="refering-page" type="radio" value="4" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            </div>
            <div>
                <label for="helper-radio" class="font-medium text-gray-900">Referring page</label>
                <p id="refering-page" class="{{ $trackingOption==4 ? '' : 'hidden' }} text-xs font-normal text-gray-500">Visitors who are referred from <input placeholder="websitename.com" type="text"></p>

            </div>
        </div>
    </div>

    <div class="py-4 mt-4 space-y-2 font-medium">
        <p class="text-lg sm:text-xl">Swap target</p>

        <p class="text-xs font-normal text-gray-500">
            This is the phone number we look for on your website to dynamically replace with a tracking number. <br>
            Typically, this is the primary business phone number or the destination number.</p>
        <input x-mask="(999)999-9999" placeholder="(123)456-7890" type="tel" wire:model.live="swapTarget">
    </div>

</div>