<div class="{{ $pageCnt == 7 ? '' : 'hidden' }}">
    <div class="bg-white px-5 py-5">
        <p class="mb-5 text-2xl text-left sm:text-2xl font-bold">Congrats! <i>{{ $poolName }}</i> is ready to take calls</p>
        <hr class="h-px my-8 bg-gray-200 border-0">
        <p class="mb-5 text-xl text-left sm:text-xl">Here are the details of your new website pool:</p>
        <hr class="h-px my-8 bg-gray-200 border-0">
        <ul class="text-left">
            <li> Name: <strong>{{ $poolName }}</strong></li>
            <li> Numbers Area Code: <strong>{{ $areaCode}}</strong> </li>
            <li> Forward Calls to: <strong>{{ $callForwarding }}</strong></li>
            <li> Phone Number: <strong>{{ $selectedNumber }}</strong> </li>

        </ul>
    </div>

</div>


{{-- 
<div class="{{ $pageCnt == 7 ? '' : 'hidden' }}">
    <div class="bg-white px-5 py-5">
    
        <p class="mb-5 text-xl text-left sm:text-xl">NUMBER FEATURES</p>
        
    
        <div class="flex">
            <div class="flex h-5">
                <input id="helper-checkbox" aria-describedby="helper-checkbox-text" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
            </div>
            <div class="ms-2 text-sm space-y-2">    
                <label for="helper-checkbox" class="mb-5 text-lg mt-5 font-semibold text-left sm:text-lg">Call Recording</label>
                <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500">Activate call recording to listen to past calls and power premium AI features like transcriptions, conversations sumamries, and call insights. Use the box below to customize a short greetings to the caller.</p>
                <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">This call will be recorded for quality assurance.</textarea>
                <button ><x-atoms.icons.play />Preview Message</button>
            </div>
        </div>
        <div class="flex">
            <div class="flex items-start h-5">
                <input id="helper-checkbox" aria-describedby="helper-checkbox-text" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"/>
            </div>
            <div class="ms-2 text-sm">
                <label for="helper-checkbox" class="mb-5 text-lg mt-5 font-semibold text-left sm:text-lg">Whisper Message</label>
                <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500">A short message that plays before the call. The caller does not hear this message.</p>
                <input type="text" value="Call form [source]"/>

                <button ><x-atoms.icons.play />Preview Message</button>
            </div>
        </div>
        <div class="flex w-full mt-10 space-x-10">
            <button class="bg-white flex-auto w-1/2">Website Pool Setup</button>
            <button class="bg-white flex-auto w-1/2">Activate Tracking Number</button>
        </div>
    </div>
</div> --}}