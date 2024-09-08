@props(
    ['active' => false, 'icon'=> "dashboard" ]
)


<a wire:navigate.hover
     
    data-tooltip-placement="right" 
    class="{{ $active ? 'bg-gray-100': '' }} flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group" 
    {{ $attributes }}
    >


    <svg class="w-6 h-6 transition duration-75 group-hover:text-gray-900 {{ $active ? 'text-gray-900': 'text-gray-500' }}" 
    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    @switch($icon)
        @case('dashboard')
            echo <path d='M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z'></path>
            <path d='M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z'></path>;
            @break
        @case('companies')
            echo <path d="m5.5 7.7 1-2.7h11A56 56 0 0 1 19 9.7v.6l-.3.4a1 1 0 0 1-.4.2.8.8 0 0 1-.6 0 1 1 0 0 1-.4-.2l-.2-.4-.1-.6a1 1 0 1 0-2 0c0 .4-.1.7-.3 1a1 1 0 0 1-.7.3.9.9 0 0 1-.7-.3c-.2-.3-.3-.6-.3-1a1 1 0 1 0-2 0c0 .4-.1.7-.3 1a1 1 0 0 1-.7.3.9.9 0 0 1-.7-.3c-.2-.3-.3-.6-.3-1a1 1 0 0 0-2 0 1.5 1.5 0 0 1-.2.8l-.1.2a1 1 0 0 1-.4.2L6 11a1 1 0 0 1-.5-.3h-.1c-.2-.3-.4-.6-.4-1v-.2l.1-.5.4-1.3ZM4 12l-.1-.1A3.5 3.5 0 0 1 3 9.7l.2-1.2a26.3 26.3 0 0 1 1.4-4.2A2 2 0 0 1 6.5 3h11a2 2 0 0 1 1.8 1.2A58 58 0 0 1 21 9.7a3.5 3.5 0 0 1-.8 2.3l-.2.2V19a2 2 0 0 1-2 2h-6a1 1 0 0 1-1-1v-4H8v4c0 .6-.4 1-1 1H6a2 2 0 0 1-2-2v-6.9Zm9 2.9c0-.6.4-1 1-1h2c.6 0 1 .4 1 1v2c0 .6-.4 1-1 1h-2a1 1 0 0 1-1-1v-2Z"></path>;
            @break
    @default

    
    @endswitch
    </svg>
 
    <div id="tooltip-{{$icon}}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
            {{ $slot}}<div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</a>