<main>
    <div id="large-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <div class="relative bg-white rounded-lg shadow ">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="large-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5">
                    <h3 class="mb-5 text-2xl font-semibold text-gray-900 text-center">Exit Number Creation?</h3>
                    <h4 class="mb-5 text-2xl font-semibold text-gray-900 text-justify">The settings and tracking numbers you've chosen won't be saved.</h4>
                    
                    <button data-modal-hide="large-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        No, cancel</button>
                    <a data-modal-hide="large-modal" href="{{route('home')}}" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-20 text-center">
        <h1 class="mb-2 pt-4 text-3xl font-bold text-gray-900">Create Tracking Number</h1>
        <button data-modal-target="large-modal" data-modal-toggle="large-modal" class="absolute top-5 end-5 text-gray-500 font-medium text-xl px-5 py-2.5 text-center type="button">
                X
        </button>
        <p class="mb-5 text-base text-gray-500 sm:text-lg ">Company Name</p>

        <div class="my-4 w-full">
            <progress id="file" value="{{ $percent[$pageCnt] }}" max="100" class="w-full progress-unfilled:bg-gray-300 progress-filled:bg-blue-700">  </progress>
            <label for="file" class="w-1/4">{{ $percent[$pageCnt] }}% Complete</label>
        </div>
    </div>


    <div class="w-screen mx-16 my-16 text-center ">
        <div class="w-screen px-6 rounded-lg {{ $pageCnt >= 4 ? 'bg-white' : '' }} -mt-10 pt-4">
        
            <div class="{{ $pageCnt == 0 ? '' : 'hidden' }}">
                <p class="mb-5 text-xl text-left sm:text-xl font-semibold">Where will you display this tracking number?</p>
                
                <div class="w-full mb-10 items-center justify-center space-y-10 sm:flex sm:space-y-0 sm:mt-10 space-x-10  rtl:space-x-reverse">
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">On my Website</div>
                                <div class="mb-1 text-base text-gray-500">We'll provide the code to install call tracking.</div>
                            </div>
                        </button>
                    </div>
                    <div class="w-full">
                    <button href="#" class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                        <div class="text-center">
                        <div class="-mt-1 font-sans text-xl font-bold">Somewhere else</div>
                        <div class="mb-1 text-base text-gray-500">Google Ads, email signatures, and more.</div>
                        </div>
                    </button>
                    </div>
                </div>
            </div>

            <!-- -------------------------------------------------------------------------------------------------------------------- -->

            <div class="{{ $pageCnt == 1 ? '' : 'hidden' }}">
                <p class="mb-5 text-xl text-left sm:text-xl font-semibold">What would you like to track?</p>
                
                <div class="w-full mb-10 items-center justify-center space-y-10 sm:flex sm:space-y-0 sm:mt-10 space-x-10  rtl:space-x-reverse">
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                            
                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">Calls, keywords, & Web sessions</div>
                                <div class="mb-1 text-base text-gray-500">Use a website pool to track details from campaigns and web sessions.</div>
                            </div>
                        </button>
                    </div>
                    <div class="w-full">
                    <button href="#" class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                        
                        <div class="text-center">
                        <div class="-mt-1 font-sans text-xl font-bold">Calls only</div>
                        <div class="mb-1 text-base text-gray-500">Use one number to track all calls to a single campaign.</div>
                        </div>
                    </button>
                    </div>
                    
                </div>
            </div>

            <!-- -------------------------------------------------------------------------------------------------------------------- -->
            
            <div class="{{ $pageCnt == 2 ? '' : 'hidden' }}">
                <p class="mb-5 text-xl text-left sm:text-xl font-semibold">Will this number be used in a Google Ads extension?</p>
                
                <div class="w-full mb-10 items-center justify-center space-y-10 sm:flex sm:space-y-0 sm:mt-10 space-x-10  rtl:space-x-reverse">
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                            
                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">Yes, in an ad extension.</div>
                                <div class="mb-1 text-base text-gray-500">Call only ads, call extensions, and message extension.</div>
                            </div>
                        </button>
                    </div>
                    <div class="w-full">
                    <button href="#" class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                        
                        <div class="text-center">
                        <div class="-mt-1 font-sans text-xl font-bold">No, somewhere else.</div>
                        <div class="mb-1 text-base text-gray-500">Facebook ads, email signatures, and more).</div>
                        </div>
                    </button>
                    </div>
                    
                </div>
            </div>

            <!-- -------------------------------------------------------------------------------------------------------------------- -->

            <div class="{{ $pageCnt == 3 ? '' : 'hidden' }}">
                <p class="mb-5 text-xl text-left sm:text-xl font-semibold">Where will your Google ads be displayed?</p>
                
                <div class="w-full mb-10 items-center justify-center space-y-10 sm:flex sm:space-y-0 sm:mt-10 space-x-10  rtl:space-x-reverse">
                    <div class="w-full">
                        <button class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                            
                            <div class="text-center">
                                <div class="-mt-1 font-sans text-xl font-bold">Only on mobile devices.</div>
                                <div class="mb-1 text-base text-gray-500">You have call-only campaign or a campaign targeting mobile devices.</div>
                            </div>
                        </button>
                    </div>
                    <div class="w-full">
                    <button href="#" class="w-full bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                        
                        <div class="text-center">
                        <div class="-mt-1 font-sans text-xl font-bold">On desktop and mobile devices.</div>
                        <div class="mb-1 text-base text-gray-500">You have a campaign that is targeting multiple devices.</div>
                        </div>
                    </button>
                    </div>
                </div>
            </div>
          
            <!-- -----------------------------Tracking Options--------------------------------------------------------------- -->

            <div class="{{ $pageCnt == 4 ? '' : 'hidden' }} text-left">

                <div class="space-y-4 mb-4">
                    <p class="mb-5 text-2xl sm:text-2xl font-semibold">Tracking Options</p>
                    <hr class="h-px my-8 bg-gray-200 border-0">
                    <div class="font-medium">
                        <p class="text-xl sm:text-xl">Which visitors do you want to track?</p>
                        <p class="text-xs font-normal text-gray-500">Pick one- you can always change this later.</p>
                    </div>
                </div>

                <div class="space-y-4 text-base">
                    <div class="flex space-x-2">
                        <div class="flex items-center h-5">
                            <input  wire:model.live="trackingOption" aria-describedby="all-visitors" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" >
                        </div>
                        <div>
                            <label for="all-visitors" class="font-medium text-gray-900"> All visitors (Recommended)</label>        
                        </div>
                    </div>

                    <div class="flex space-x-2">
                        <div class="flex items-center h-5">
                            <input wire:model.live="trackingOption" aria-describedby="google-ads" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="google-ads" class="font-medium text-gray-900">Visitors from Google Ads</label>
                        </div>
                        
                    </div>

                    <div class="flex space-x-2">
                        <div class="flex items-center h-5">
                            <input wire:model.live="trackingOption" aria-describedby="ppc-search" type="radio" value="2" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="helper-radio" class="font-medium text-gray-900">PPC search</label>
                            <p id="ppc-search" class="{{ $trackingOption==2 ? '' : 'hidden' }} text-xs font-normal text-gray-500">Visitors from Google, Bing and Yahoo PPC search.</p>
                        </div>
                    </div>
                        
                    <div class="flex space-x-2">
                        <div class="flex items-center h-5">
                            <input wire:model.live="trackingOption" aria-describedby="landing-page" type="radio" value="3" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="helper-radio" class="font-medium text-gray-900">Landing Page or URL parameter</label>
                            <p id="landing-page" class="{{ $trackingOption==3 ? '' : 'hidden' }} text-xs font-normal text-gray-500">Visitors who land on. <input placeholder="xyz.com or utm_campaign=xyz" type="text"></p>
                            
                        </div>
                    </div>

                    <div class="flex space-x-2">
                        <div class="flex items-center h-5">
                            <input wire:model.live="trackingOption" aria-describedby="refering-page" type="radio" value="4" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="helper-radio" class="font-medium text-gray-900">Referring page</label>
                            <p id="refering-page" class="{{ $trackingOption==4 ? '' : 'hidden' }} text-xs font-normal text-gray-500">Visitors who are referred from <input placeholder="websitename.com" type="text"></p>
                            
                        </div>
                    </div>
                </div>

                <div class="py-4 mt-4 space-y-2 font-medium">
                    <p class="text-lg sm:text-xl">Swap target</p>
                    
                    <p class="text-xs font-normal text-gray-500">
                        This is the phone number we look for on your website to dynamically replace with a tracking number. <br>
                        Typically, this is the primary business phone number or the destination number.</p>
                    <input x-mask="(999)999-9999" placeholder="(123)456-7890" type="tel">
                </div>
         
            </div>
            <!-- -------------------------------------------------------------------------------------------------------------------- -->
            
            <div class="{{ $pageCnt == 5 ? '' : 'hidden' }} text-left space-y-4">
                <div class="space-y-4">
                    <p class="text-xl sm:text-xl">Call Forwarding</p>
                    <hr class="h-px my-8 bg-gray-200 border-0">
                    <p class="text-lg sm:text-lg">Where do you want to route these calls?</p>
                </div>
                
                <div class="space-y-4 pb-4">
                    <div class="flex space-x-2">
                        <div class="flex items-center h-5">
                            <input wire:model="callForwarding" aria-describedby="existing-phone" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        </div>
                        <div class="text-base">
                            <label for="helper-radio" class="font-medium text-gray-900">An existing phone number</label>
                            <p id="existing-phone" class="text-xs font-normal text-gray-500 mb-2">Enter an existing phone number where we should forward your calls.</p>
                            <input x-mask="(999)999-9999" placeholder="(123)456-7890" type="text">
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <div class="flex items-center h-5">
                            <input wire:model="callForwarding" aria-describedby="softphone" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        </div>
                        <div class="text-base">
                            <label for="softphone" class="font-medium text-gray-900">Lead Center's softphone</label>
                        </div>
                    </div>
                </div>
            </div>

            
            
          
            
            <!-- -------------------------------------------------------------------------------------------------------------------- -->
            
            <div class="{{ $pageCnt == 6 ? '' : 'hidden' }} text-left">
                <p class="mb-5 text-xl text-left sm:text-xl">Number Setup</p>
                <hr class="h-px my-8 bg-gray-200 border-0">
                <p class="mb-5 text-lg mt-5 font-semibold text-left sm:text-lg">How Many numbers should we add to your pool?</p>
                <div class="flex items-center"> Create <input type="text" name="" id="" x-mask="9" value="4" class="mx-2"> new tracking numbers.
                <button data-popover-target="number-description" data-popover-placement="top" type="button" class="text-blue-700"> How many numbers should we create?
                    <span class="sr-only">Show information</span></button>    
                </div>
                
                <p class="mb-5 text-lg mt-5 font-semibold text-left sm:text-lg">Which kind of numbers should we add to your pool?</p>
                
                
                <div data-popover id="number-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72">
                    <div class="p-3 space-y-2">
                        <p class="text-justify">The size of your website pool determines how many concurrent visitors we can track on your website at any given time. Your pool size should be a quarter of the peak hourly traffic reported in Google Analytics, with a minimum of 4 numbers.</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>

                <ul class="grid w-full gap-6 md:grid-cols-2">
                    <li>
                        <input type="radio" id="hosting-small" name="hosting" value="hosting-small" class="hidden peer" checked />
                        <label for="hosting-small" class="inline-flex items-center justify-between w-full p-5 bg-white border border-gray-200 rounded-lg cursor-pointer">                           
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Numbers in a specific area code</div>
                                <input type="text" x-mask="999" value="941" size="3">
                                <div class="w-full">
                                <x-atoms.icons.toast-success />
                                <x-atoms.icons.toast-failed />
                                    Number available/Number not available</div>
                            </div>
                        
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="hosting-big" name="hosting" value="hosting-big" class="hidden peer">
                        <label for="hosting-big" class="inline-flex items-center justify-between w-full p-5 bg-white border border-gray-200 rounded-lg cursor-pointer">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Toll-Free Numbers</div>
                                <div class="w-full">$2 per number per month surcharge</div>
                                <div class="space-y-6 py-8 text-base leading-7 text-gray-600">
                                <p>
                                    <input 
                                    type="text" 
                                    name="autocomplete" 
                                    class="rounded"
                                    list="some-data" 
                                    x-mask="999"
                                    size="3"/>
                                    <datalist id="some-data">
                                        <option value="866" selected/>
                                        <option value="816" />
                                        <option value="839" />
                                    </datalist>
                                </p>
                                </div>
                            </div>
                        </label>
                    </li>
                </ul>

                <p class="text-lg mt-5 font-semibold text-left sm:text-lg">What would you like to name this website pool?</p>
                <p class="mb-1 text-base text-left text-gray-500">We'll reference this number by this name in your reports and settings</p>            
                <input type="text" value="Website Pool">
            </div>
     
            

            
            <div class="{{ $pageCnt == 7 ? '' : 'hidden' }}">
                <div class="bg-white px-5 py-5">
                    <p class="mb-5 text-2xl text-left sm:text-2xl font-bold">Congrats! [NAME OF WEBSITE POOOL] is ready to take calls</p>
                    <hr class="h-px my-8 bg-gray-200 border-0">
                    <p class="mb-5 text-xl text-left sm:text-xl">Here are the details of your new website pool:</p>
                    <hr class="h-px my-8 bg-gray-200 border-0">
                    <ul class="text-left">
                        <li> Name:</li>
                        <li> Numbers Area Code:</li>
                        <li> Forward Calls to:</li>
                        <li> Call Recording:</li>

                    </ul>
                </div>

            </div>
        </div>
    </div>
    

<div class="fixed bottom-0 left-0 z-40 grid w-full h-16 grid-cols-1 px-8 bg-white border-t border-gray-200 md:grid-cols-2 ">
    <div class="items-center justify-center hidden text-gray-500 me-auto md:flex">
        <svg class="w-6 h-6 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
        </svg>
        <button type="button" class="p-2.5 group text-blue-700 hover:text-blue-800 hover:scale-105 me-1 focus:outline-none focus:ring-4 focus:ring-gray-200"
            wire:click="Decrease(1)"
        >
            Tracking Number Use
           <!-- 
                Tracking Number Display 
                Ad Extension Details
                Tracking Details
                Call Forwading
                Tracking Options
                Website Pool Setup
           -->
        </button>

        <h1>{{ $pageCnt }}</h1>
    </div>

    
    <div class="items-center justify-center hidden ms-auto md:flex">
        <button type="button" class="p-2.5 group bg-blue-700 text-white hover:bg-blue-800 me-1 focus:outline-none focus:ring-4 focus:ring-gray-200"
            wire:click="Increase(1)"
            
        >
            Tracking Options <!-- lol--> 
            <!-- 
                Website Pool Setup
                Number Features
                Activate Tracking Number
                See Active Numbers 
            -->

        </button>
        
    </div>
</div>

</main> 