@props(
    ['active' => true,
    'title' => 'Dashboard',
    'href' => '',
    'drawer' => '']
)

@if($href)
    <a wire:navigate.hover
        data-tooltip-target="tooltip-{{$title}}"
        data-tooltip-placement="right"
        href="{{ $href }}"
        class="{{ $active ? 'bg-gray-100': '' }} flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group"
        {{ $attributes }} >
        {{ $slot }}
    </a>
@elseif($drawer)
    <button
        data-tooltip-target="tooltip-{{$title}}"
        data-tooltip-placement="right"
        type="button"
        data-drawer-target="drawer-{{$drawer}}"
        data-drawer-show="drawer-{{$drawer}}"
        aria-controls="drawer-{{$drawer}}"
        {{ $attributes }} >
        {{ $slot }}
    </button>
@else
    <button type="submit"
        data-tooltip-target="tooltip-{{$title}}"
        data-tooltip-placement="right"
        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group"
        {{ $attributes}}>
        {{ $slot }}
    </button>
@endif

<div id="tooltip-{{$title}}" role="tooltip"
    class="whitespace-nowrap absolute z-10 invisible px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
        {{ $title }}
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
