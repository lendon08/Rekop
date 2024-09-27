<main class="px-2 space-y-4">
    <div class="p-6 w-full text-2xl font-bold sm:p-6">
        Companies
    </div>

    <div class="bg-white sm:flex items-center justify-between border-b border-gray-200 rounded-lg lg:mt-1.5">
        <div class="w-full mb-1 px-4">
            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 my-5 ">
                        <label for="companies-search" class="sr-only">Search</label>
                        <div class="relative mt-1 lg:w-64 xl:w-96">
                            <input type="text" wire:model.live="search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Search for companies" autocomplete="false">
                            <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div>
                        </div>
                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    
                    <x-atoms.forms.button wire:click="create" variant="primary">
                        <x-atoms.icons.plus></x-atoms.icons.plus>
                        Add Company
                    </x-atoms.forms.button>
                        {{-- TODO --}}
                    <x-atoms.forms.button href="#" class="border-gray-300 border-2">
                        <x-atoms.icons.download></x-atoms.icons.download>
                        Export
                    </x-atoms.forms.button>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col pb-16">
        <div class="overflow-x-auto">
            <x-organisms.table>
                <x-molecules.tables.thead>
                    <tr>
                        <x-atoms.tables.th>#</x-atoms.tables.th>
                        <x-atoms.tables.th>Name</x-atoms.tables.th>
                        <x-atoms.tables.th>Location</x-atoms.tables.th>
                        <x-atoms.tables.th>Lead Value</x-atoms.tables.th>
                        <x-atoms.tables.th>Actions</x-atoms.tables.th>
                    </tr>
                </x-molecules.tables.thead>
                <x-molecules.tables.tbody>
                    @if($companies->isNotEmpty())
                        @foreach($companies as $company)
                            <tr wire:key="{{ $company->id }}">
                                <x-atoms.tables.td>{{ $loop->iteration }}</x-atoms.tables.td>
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
                                            <x-atoms.tables.dropdown-list wire:click="destroy({{$company->id}})">
                                                <x-atoms.icons.trash />Delete company
                                            </x-atoms.tables.dropdown-list>
                                        </x-atoms.tables.dropdown-unordered>
                                    </x-molecules.tables.dropdown>

                                </x-atoms.tables.td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <x-atoms.tables.td></x-atoms.tables.td>
                        </tr>
                    @endif
                </x-molecules.tables.tbody>
            </x-organisms.table>
        </div>
    </div>
    <div class="fixed bottom-0 pt-4 left-1 pl-16 z-40 grid w-full h-16 grid-cols-1 px-8 bg-white border-t border-gray-200 justify-between">
       {{ $companies->links() }}
    </div>
</main>