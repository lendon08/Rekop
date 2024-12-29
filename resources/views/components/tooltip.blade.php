@props(
    ['title' => 'Dashboard']
)


{{-- <div
    data-tooltip-target="tooltip-{{$title}}"
    data-tooltip-placement={{$placement}}
    class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group"
    {{ $attributes }} >
    {{ $slot }}
</div> --}}


<div id="{{$title}}" role="tooltip"
    class="whitespace-nowrap absolute z-10 invisible px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
        {{ $slot }}
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
