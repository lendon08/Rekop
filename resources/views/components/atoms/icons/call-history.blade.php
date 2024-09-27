@props(
    ['active' => false]
)
<svg class="w-6 h-6 transition duration-75 group-hover:text-gray-900 {{ $active ? 'text-gray-900': 'text-gray-500' }}" 
    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path d="M20.3 8H16m3.8 3H16m4-6h-9v11h8.3L21 6.2A1 1 0 0 0 20 5ZM6.7 13.2h-.9V8.8h1c.3 0 .6-.1.8-.3.2-.1.3-.4.3-.6L8 6a.9.9 0 0 0-.3-.7A1 1 0 0 0 7 5H5c-.2 0-.5 0-.7.2l-.4.5A15 15 0 0 0 3 11c0 1.8.2 3.5.8 5.2.2.5 1.3.8 1.9.8h1a1 1 0 0 0 .8-.3l.2-.4V16l-.1-2a1 1 0 0 0-.3-.5 1 1 0 0 0-.7-.3ZM10 18v1h10v-1a2 2 0 0 0-2-2h-6a2 2 0 0 0-2 2Z" />
</svg>