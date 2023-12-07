<div>
    @if ($showToast)   
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-400 border" role="alert">
            <div class="flex">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg ">
                    <x-atoms.icons.toast-success />
                </div>
                <div class="ml-3 text-sm font-normal">
                    <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $title }}</span>
                    <div class="mb-1 text-sm font-normal dark:text-white">{{ $message }}</div> 
                </div>
            </div>
        </div>
    @endif
</div>