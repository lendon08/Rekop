
<div data-popover role="tooltip"
{{ $attributes->merge(['class' => 'absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0']) }} >
    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg">
        <h3 class="font-semibold text-gray-900">{{ $slot }}</h3>
    </div>
    <div data-popper-arrow></div>
</div>