<div>
    @if ($showToast)   
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow border" role="alert">
            <div class="flex">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg ">
                    @switch($mode)
                        @case("success")
                            <x-atoms.icons.toast-success />
                            @break 
                        @case("failed")
                            <x-atoms.icons.toast-failed />
                            @break
                    @endswitch    
                </div>
                <div class="ml-3 text-sm font-normal">
                    <span class="mb-1 text-sm font-semibold text-gray-900">{{ $title }}</span>
                    <div class="mb-1 text-sm font-normal">{{ $message }}</div> 
                </div>
            </div>
        </div>
    @endif
</div>