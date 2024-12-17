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
    <div class="flex justify-between mb-10">
        <span class="font-bold font-2xl">{{auth()->user()->company->name}}</span>
        <span class="font-semibold text-gray-200">  #: {{ str_pad(auth()->user()->company->id, 5, '0', STR_PAD_LEFT) }}</span>
    </div>
    <div class="flex flex-col space-y-4">
        <x-atoms.forms.button href="#" variant="secondary" class='transform hover:scale-105 transition duration-200'>
            Account Settings
        </x-atoms.forms.button>
        <x-atoms.forms.button href="#" variant="secondary" class='transform hover:scale-105 transition duration-200'>
            Users
        </x-atoms.forms.button>
        <x-atoms.forms.button href="#" variant="secondary" class='transform hover:scale-105 transition duration-200'>
            Notification
        </x-atoms.forms.button>
    </div>
 </div>
