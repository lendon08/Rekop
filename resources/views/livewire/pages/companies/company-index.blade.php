<div>
    <div class="p-6 w-full text-2xl font-bold sm:p-6">
        Companies
    </div>

    <div class="bg-white sm:flex items-center justify-between border-b border-gray-200 rounded-lg lg:mt-1.5">
        <div class="w-full mb-1 px-4">
            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 my-5 ">
                    <form class="lg:pr-3" action="#" method="GET">
                        <label for="companies-search" class="sr-only">Search</label>
                        <div class="relative mt-1 lg:w-64 xl:w-96">
                            <input type="text" name="email" id="companies-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Search for companies" autocomplete="false">
                            <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div>
                        </div>
                    </form>

                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <!-- app/http/livewire/Companies/CompanyForm  for create function-->
                    <button type="button" wire:click="create" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 sm:w-auto">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add Company
                    </button>
                    <a href="#" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                        </svg>
                        Export
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <x-organisms.table>
                <x-molecules.tables.thead>
                    <tr>
                        <x-atoms.tables.th>Name</x-atoms.tables.th>
                        <x-atoms.tables.th>Location</x-atoms.tables.th>
                        <x-atoms.tables.th>Lead Value</x-atoms.tables.th>
                        <x-atoms.tables.th>Actions</x-atoms.tables.th>
                    </tr>
                </x-molecules.tables.thead>
                <x-molecules.tables.tbody>
                    @foreach($companies as $company)
                    <tr>
                        <x-atoms.tables.td>{{ $company->name }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $company->location }}</x-atoms.tables.td>
                        <x-atoms.tables.td>{{ $company->lead_value }}</x-atoms.tables.td>
                        <x-atoms.tables.td>
                            <x-atoms.forms.button onclick="openDropdown(`company-dropdown-{{$company->id}}`)">
                                <x-atoms.icons.dropdown-dots />
                            </x-atoms.forms.button>

                            <x-molecules.tables.dropdown id="company-dropdown-{{$company->id}}">
                                <x-atoms.tables.dropdown-unordered>
                                    <x-atoms.tables.dropdown-list wire:click="update({{$company->id}})">
                                        <x-atoms.icons.edit />Update company
                                    </x-atoms.tables.dropdown-list>
                                    <x-atoms.tables.dropdown-list wire:click="confirm({{$company->id}})">
                                        <x-atoms.icons.trash />Delete company
                                    </x-atoms.tables.dropdown-list>
                                </x-atoms.tables.dropdown-unordered>
                            </x-molecules.tables.dropdown>

                        </x-atoms.tables.td>
                    </tr>
                    @endforeach
                </x-molecules.tables.tbody>
            </x-organisms.table>
        </div>
    </div>
    <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between">
        <div class="flex items-center mb-4 sm:mb-0 sm:flex">
            <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="#" class="inline-flex justify-center p-1 mr-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <span class="text-sm font-normal text-gray-500">Showing <span class="font-semibold text-gray-900">1-20</span> of <span class="font-semibold text-gray-900">2290</span></span>
        </div>
        <div class="flex items-center space-x-3">
            <a href="#" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300">
                <svg class="w-5 h-5 mr-1 -ml-1" "="" fill=" currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Previous
            </a>
            <a href="#" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300">
                Next
                <svg class="w-5 h-5 ml-1 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>
</div>