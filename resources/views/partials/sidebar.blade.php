<aside id="sidebar" class="fixed left-0 z-20 flex flex-col flex-shrink-0 hidden w-16 h-full font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
  <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-20">
    <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
      <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-20">
        <ul class="pb-2 space-y-2">
          <li>
            <form action="#" method="GET" class="lg:hidden">
              <label for="mobile-search" class="sr-only">Search</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" name="email" id="mobile-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 " placeholder="Search" autocomplete="false">
              </div>
            </form>
          </li>
          <li>
            <a wire:navigate href="/" data-tooltip-target="tooltip-dashboard" data-tooltip-placement="right" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group" @class(['bg-gray-100' => request()->is('/')] )>
                <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                <!-- <span class="ml-3" sidebar-toggle-item="">Dashboard</span> -->
                <div id="tooltip-dashboard" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                      Dashboard
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </a>
          </li>
          <li>
            <a wire:navigate href="/companies" 
            @class(['flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group',
            'bg-gray-100' => request()->is('/companies'),]) data-tooltip-target="tooltip-companies" data-tooltip-placement="right">
            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="m5.5 7.7 1-2.7h11A56 56 0 0 1 19 9.7v.6l-.3.4a1 1 0 0 1-.4.2.8.8 0 0 1-.6 0 1 1 0 0 1-.4-.2l-.2-.4-.1-.6a1 1 0 1 0-2 0c0 .4-.1.7-.3 1a1 1 0 0 1-.7.3.9.9 0 0 1-.7-.3c-.2-.3-.3-.6-.3-1a1 1 0 1 0-2 0c0 .4-.1.7-.3 1a1 1 0 0 1-.7.3.9.9 0 0 1-.7-.3c-.2-.3-.3-.6-.3-1a1 1 0 0 0-2 0 1.5 1.5 0 0 1-.2.8l-.1.2a1 1 0 0 1-.4.2L6 11a1 1 0 0 1-.5-.3h-.1c-.2-.3-.4-.6-.4-1v-.2l.1-.5.4-1.3ZM4 12l-.1-.1A3.5 3.5 0 0 1 3 9.7l.2-1.2a26.3 26.3 0 0 1 1.4-4.2A2 2 0 0 1 6.5 3h11a2 2 0 0 1 1.8 1.2A58 58 0 0 1 21 9.7a3.5 3.5 0 0 1-.8 2.3l-.2.2V19a2 2 0 0 1-2 2h-6a1 1 0 0 1-1-1v-4H8v4c0 .6-.4 1-1 1H6a2 2 0 0 1-2-2v-6.9Zm9 2.9c0-.6.4-1 1-1h2c.6 0 1 .4 1 1v2c0 .6-.4 1-1 1h-2a1 1 0 0 1-1-1v-2Z"></path></svg>
              <div id="tooltip-companies" role="tooltip" class="whitespace-nowrap absolute z-10 invisible px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                Companies
                  <div class="tooltip-arrow" data-popper-arrow></div>
              </div>    
            <!-- <span class="ml-3" sidebar-toggle-item="">Companies</span> -->
            </a>
          </li>
          <li>
          <li>
            <a wire:navigate href="/call-histories" data-tooltip-target="tooltip-call-history" data-tooltip-placement="right"  class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group">
                <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M20.3 8H16m3.8 3H16m4-6h-9v11h8.3L21 6.2A1 1 0 0 0 20 5ZM6.7 13.2h-.9V8.8h1c.3 0 .6-.1.8-.3.2-.1.3-.4.3-.6L8 6a.9.9 0 0 0-.3-.7A1 1 0 0 0 7 5H5c-.2 0-.5 0-.7.2l-.4.5A15 15 0 0 0 3 11c0 1.8.2 3.5.8 5.2.2.5 1.3.8 1.9.8h1a1 1 0 0 0 .8-.3l.2-.4V16l-.1-2a1 1 0 0 0-.3-.5 1 1 0 0 0-.7-.3ZM10 18v1h10v-1a2 2 0 0 0-2-2h-6a2 2 0 0 0-2 2Z"/>
                </svg>
                <div id="tooltip-call-history" role="tooltip" class="whitespace-nowrap absolute z-10 invisible px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                      <div>Call History</div>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
        
                <!-- <span class="ml-3" sidebar-toggle-item="">Call History</span> -->
            </a>
          </li>
            <a wire:navigate href="phone-settings" data-tooltip-target="tooltip-phonesetting" data-tooltip-placement="right"  class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group ">
                <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path clip-rule="evenodd" fill-rule="evenodd" d="M8.34 1.804A1 1 0 019.32 1h1.36a1 1 0 01.98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 011.262.125l.962.962a1 1 0 01.125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 01.804.98v1.361a1 1 0 01-.804.98l-1.473.295a6.95 6.95 0 01-.587 1.416l.834 1.25a1 1 0 01-.125 1.262l-.962.962a1 1 0 01-1.262.125l-1.25-.834a6.953 6.953 0 01-1.416.587l-.294 1.473a1 1 0 01-.98.804H9.32a1 1 0 01-.98-.804l-.295-1.473a6.957 6.957 0 01-1.416-.587l-1.25.834a1 1 0 01-1.262-.125l-.962-.962a1 1 0 01-.125-1.262l.834-1.25a6.957 6.957 0 01-.587-1.416l-1.473-.294A1 1 0 011 10.68V9.32a1 1 0 01.804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 01.125-1.262l.962-.962A1 1 0 015.38 3.03l1.25.834a6.957 6.957 0 011.416-.587l.294-1.473zM13 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <div id="tooltip-phonesetting" role="tooltip" class="whitespace-nowrap absolute z-10 invisible px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                      Phone Settings
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <!-- <span class="ml-3" sidebar-toggle-item="">Phone Settings</span> -->
            </a>
          </li>
          
          <!-- <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100" aria-controls="dropdown-layouts" data-collapse-toggle="dropdown-layouts">
                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                </svg>
                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item="">Layouts</span>
                <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <ul id="dropdown-layouts" class="hidden py-2 space-y-2">
              <li>
                <a wire:navigate href="#layouts/stacked/" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Clients</a>
              </li>
              <li>
                <a wire:navigate href="#layouts/sidebar/" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Companies</a>
              </li>
            </ul>
          </li> -->
          
        
        </ul>
       
      </div>
    </div>

  </div>
</aside>
<div class="fixed inset-0 z-10 hidden bg-gray-900/50" id="sidebarBackdrop"></div>
