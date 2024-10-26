<div class="{{ $pageCnt == 6 ? '' : 'hidden' }} text-left">
    <p class="mb-5 text-2xl sm:text-2xl font-semibold">Number Setup</p>
    <hr class="h-px my-8 bg-gray-200 border-0">
    <p class="mb-5 text-lg mt-5 font-semibold text-left sm:text-lg">How Many numbers should we add to your pool?</p>
    <div class="flex items-center"> Create <input type="text" wire:model="numberOfTracking" x-mask="9" value="4" class="mx-2"> new tracking numbers.
        <button data-popover-target="number-description" data-popover-placement="top" type="button" class="text-blue-700"> How many numbers should we create?
            <span class="sr-only">Show information</span></button>
    </div>

    <p class="mb-5 text-lg mt-5 font-semibold text-left sm:text-lg">Which kind of numbers should we add to your pool?</p>


    <div data-popover id="number-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72">
        <div class="p-3 space-y-2">
            <p class="text-justify">The size of your website pool determines how many concurrent visitors we can track on your website at any given time. Your pool size should be a quarter of the peak hourly traffic reported in Google Analytics, with a minimum of 4 numbers.</p>
        </div>
        <div data-popper-arrow></div>
    </div>

    <ul class="grid w-full gap-6 md:grid-cols-2">
        <li>
            <input
                type="radio"
                id="hosting-small"
                name="hosting"
                value="hosting-small"
                class="hidden peer"
                checked
                 />
            <label
                for="hosting-small"
                class="inline-flex w-full p-5 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 min-h-60">
                <div>
                    <div class="text-lg font-semibold">Numbers in a specific area code</div>
                    <input
                        type="text"
                        x-mask="999"
                        size="3"
                        wire:model.live="areaCode"
                        wire:keydown="searchNumber"
                        class="peer-checked:enabled peer-disabled:opacity-50" />
                    <div class="my-2">
                        <!-- Display messages based on area code length -->
                        @if(strlen($areaCode) == 3)
                            @if(empty($availableNumbers))
                            <p class="text-red-500">No Available Number in that area code</p>
                            @else
                            @foreach($availableNumbers as $key => $numbers)
                            <div class="flex-auto me-4">
                                <input id="inline-checked-radio{{$key}}" type="radio" wire:model.live="selectedNumber" value="{{ $numbers}}" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="inline-checked-radio{{$key}}" class="ms-2 text-sm font-medium">{{ $numbers }}</label>
                            </div>
                            @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </label>
        </li>
        <li x-data="{ isEnabled: false }">
            <input
                type="radio"
                id="hosting-big"
                name="hosting"
                value="hosting-big"
                class="hidden peer"
                @click="this.isEnabled = !this.isEnabled" />
            <label
                for="hosting-big"
                class="inline-flex w-full p-5 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 min-h-60">
                <div>
                    <div class="text-lg font-semibold">Toll-Free Numbers</div>
                    <div class="mt-1">$2 per number per month surcharge</div>
                    <div class="space-y-6 py-8 text-base leading-7 text-gray-600">
                        <p>
                            <input
                                type="text"
                                name="autocomplete"
                                class="rounded peer-checked:enabled peer-disabled:opacity-50"
                                list="some-data"
                                x-mask="999"
                                size="3"
                                :disabled="!this.isEnabled" />
                            <datalist id="some-data">
                                <option value="866" selected />
                                <option value="816" />
                                <option value="839" />
                            </datalist>
                        </p>
                    </div>
                </div>
            </label>
        </li>
    </ul>



    <p class="text-lg mt-5 font-semibold text-left sm:text-lg">What would you like to name this website pool?</p>
    <p class="mb-1 text-base text-left text-gray-500">We'll reference this number by this name in your reports and settings</p>
    <input type="text" name="websitepool" wire:model="poolName">
</div>
