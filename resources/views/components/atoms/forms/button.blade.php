@props([
'variant' => 'default',
'href' => null,
'type' => 'button',
])

@php
$class = '';
switch ($variant) {
    case 'success':
        $class = 'inline-flex items-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 sm:w-auto';
        break;
    case 'warning':
        $class = 'inline-flex items-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400 hover:bg-yellow-500sm:w-auto';
        break;
    case 'danger':
        $class = 'inline-flex items-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 sm:w-auto';
        break;
    case 'secondary':
        $class = 'inline-flex items-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-700 hover:bg-gray-800 sm:w-auto';
        break;
    case 'primary':
        $class = 'inline-flex items-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 sm:w-auto';
        break;
    case 'top_nav':
        $class = 'relative group px-4 py-2 focus:outline-none text-lg';
        break;
    default:
        $class = 'inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-transparent rounded-lg hover:bg-gray-100 focus:ring-gray-50';
    break;
}
@endphp
@if($variant == 'top_nav')
    <button {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
        <span class="absolute bottom-0 left-1/2 w-0 h-[2px] bg-blue-600 transition-all duration-300 ease-in-out group-hover:w-1/2 group-hover:-translate-x-1/2 group-focus:w-1/2 group-focus:-translate-x-1/2"></span>
    </button>
@else
    @if ($href)
        <a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
            {{ $slot }}
        </a>
    @else
        <button type="{{ $type }}" {{ $attributes->merge(['class' => $class]) }}>
            {{ $slot }}
        </button>
    @endif
@endif
