<main class="px-2 space-y-4 overflow-x-hidden">

    <x-organisms.settings-nav></x-organisms.settings-nav>

    <div class="p-6 w-full text-2xl font-bold sm:p-6">
        Integrations library
    </div>

    <div class="bg-white block sm:flex border-b border-gray-200 p-4">
        <div class="flex flex-col">
            <div class="font-xl">
                Recommended for You
            </div>
            <div class='flex space-x-4'>

                <a href="{{ route('settings-integration-edit', ['slug' => 'javascript']) }}"
                    class="max-w-sm p-6 bg-white transform hover:scale-105 transition duration-200">
                    <div class="flex space-x-2">

                        <div class="flex flex-col justify-between">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 8-4 4 4 4m8 0 4-4-4-4m-2-3-4 14"/>
                              </svg>
                              <div >
                                {{-- change color depending on state --}}
                                active
                              </div>
                        </div>

                        <div class="flex flex-col">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Javascript Snippet</h5>
                            <p class="font-normal text-gray-700 ">Capture visitor and session activity on a site.</p>
                        </div>
                    </div>

                </a>

            </div>
        </div>
    </div>

</main>
