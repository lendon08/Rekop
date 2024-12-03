<aside id="sidebar" class="hidden fixed left-0 z-50 flex-col flex-shrink-0 w-16 h-full font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
  <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-20 justify-between">
    <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
      <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-20">
        <ul class="pb-2 space-y-2">
            <li>
                <x-nav-link
                    title='{{auth()->user()->company->name}}'
                    drawer='form'
                    >

                    <x-atoms.icons.home></x-atoms.icons.home>

                </x-nav-link>
            </li>
            <li>
                <x-nav-link
                    href="/dashboard"
                    :active="request()->is('dashboard')"
                    title="Dashboard">
                <x-atoms.icons.dashboard :active="request()->is('dashboard')"></x-atoms.icons.dashboard>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link
                    href="/companies"
                    :active="request()->is('companies')"
                    title="Company">
                <x-atoms.icons.company :active="request()->is('companies')"></x-atoms.icons.company>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link
                    href="/call-histories"
                    :active="request()->is('call-histories')"
                    title="Call history">
                <x-atoms.icons.call-history :active="request()->is('call-histories')"></x-atoms.icons.call-history>
                </x-nav-link>
            </li>
                <x-nav-link
                    href="/phone-settings"
                    :active="request()->is('phone-settings')"
                    title="Phone Settings">
                <x-atoms.icons.phone-settings :active="request()->is('phone-settings')"></x-atoms.icons.phone-settings>
                </x-nav-link>
            </li>
        </ul>

      </div>
    </div>


    {{-- lower part --}}
    <div class="mb-20">
      <form method="post" action="{{ route('logout') }}" >
        @csrf
        <div class="flex justify-center">
          <x-nav-link title="Logout">
              <x-atoms.icons.logout></x-atoms.icons.call-history>
            </x-nav-link>
          {{-- <button type="submit" data-tooltip-target="tooltip-logout" data-tooltip-placement="right">

            <div id="tooltip-logout" role="tooltip" class="whitespace-nowrap absolute z-10 invisible px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
              Logout
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
          </button> --}}
        </div>
      </form>

    </div>
  </div>

</aside>
<div class="fixed inset-0 z-10 hidden bg-gray-900/50" id="sidebarBackdrop"></div>






 <!-- drawer component -->
 <div id="drawer-form" class="fixed top-0 left-0 ml-16 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-96 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-form-label">
    <span><a href="">My Profile</a></span>
    <button type="button" data-drawer-hide="drawer-form" aria-controls="drawer-form" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
       <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
       </svg>
       <span class="sr-only">Close menu</span>
    </button>
    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="flex justify-between">
        <span class="font-bold">{{auth()->user()->company->name}}</span>
        <span class="font-semibold text-gray-200">#: 0000{{auth()->user()->company->id}}</span>
    </div>
    <form class="mb-6">
       <div class="mb-6">
          <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
          <input type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Apple Keynote" required />
       </div>
       <div class="mb-6">
          <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
          <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write event description..."></textarea>
       </div>
       <div class="relative mb-6">
          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
             <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
             </svg>
          </div>
          <input datepicker="" datepicker-autohide datepicker-buttons="" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Select date">
       </div>
       <div class="mb-4">
          <label for="guests" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Invite guests</label>
          <div class="relative">
             <input type="search" id="guests" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add guest email" required />
             <button type="button" class="absolute inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-700 rounded-lg end-2 bottom-2 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
     <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
   </svg>Add</button>
          </div>
       </div>

       <button type="submit" class="text-white justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><svg class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
     <path d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z"/>
     <path d="M8.139 10.411 5.289 13.3A1 1 0 0 0 5 14v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .7-.288l2.886-2.851-3.447-3.45ZM14 8a2.463 2.463 0 0 0-3.484 0l-.971.983 3.468 3.468.987-.971A2.463 2.463 0 0 0 14 8Z"/>
   </svg> Create event</button>
    </form>
 </div>
