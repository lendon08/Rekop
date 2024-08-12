<div>
    @if ($paginator->hasPages())
        <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between">
            <div class="flex items-center hidden mb-4 sm:mb-0 sm:flex">
                <span class="text-sm font-normal text-gray-500">Showing <span class="font-semibold text-gray-900">{{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}</span> of <span class="font-semibold text-gray-900">{{ $paginator->total() }}</span></span>
            </div>
            <div class="flex items-center space-x-3">
                @if (!$paginator->onFirstPage())
                    <button wire:click="previousPage('page')" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300">
                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        Previous
                    </button>
                @endif
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage('page')" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300">
                        Next
                        <svg class="w-5 h-5 ml-1 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </button>
                @endif
            </div>
        </div>
    @endif
</div>
