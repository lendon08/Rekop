<aside id="sidebar" class="hidden fixed left-0 z-50 flex-col flex-shrink-0 w-16 h-full font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
  <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-20 justify-between">
    <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
      <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-20">
        <ul class="pb-2 space-y-2">
          <li>
            <x-nav-link href="/dashboard"
              :active="request()->is('dashboard')"
              title="Dashboard">
              <x-atoms.icons.dashboard :active="request()->is('dashboard')"></x-atoms.icons.dashboard>
            </x-nav-link>
          </li>
          <li>
            <x-nav-link href="/companies"
              :active="request()->is('companies')"
              title="Company">
              <x-atoms.icons.company :active="request()->is('companies')"></x-atoms.icons.company>
            </x-nav-link>
          </li>
          <li>
            <x-nav-link href="/call-histories"
              :active="request()->is('call-histories')"
              title="Call history">
              <x-atoms.icons.call-history :active="request()->is('call-histories')"></x-atoms.icons.call-history>
            </x-nav-link>
          </li>
            <x-nav-link href="/phone-settings"
              :active="request()->is('phone-settings')"
              title="Phone Settings">
              <x-atoms.icons.phone-settings :active="request()->is('phone-settings')"></x-atoms.icons.phone-settings>
            </x-nav-link>
          </li>
        </ul>

      </div>
    </div>
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