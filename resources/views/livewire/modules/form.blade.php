<div>

    @php
        $size = ($isConfirm) ? 'xs' : 'xl';
    @endphp

    @if ($isOpen)
        <div class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30"></div>
        <div class="fixed top-0 right-0 z-40 w-full h-screen max-w-{{$size}} p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800 transform-none border-l-4 border-gray-200">
            @livewire($form, compact('action', 'data'))
        </div>
    @endif
    
</div>
