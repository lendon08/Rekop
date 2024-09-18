<div class="{{ $pageCnt == 8 ? '' : 'hidden' }}">
    <div class="bg-white px-5 py-5">
        <p class="mb-5 text-2xl text-left sm:text-2xl font-bold">Congrats! {{ $websitepool }} is ready to take calls</p>
        <hr class="h-px my-8 bg-gray-200 border-0">
        <p class="mb-5 text-xl text-left sm:text-xl">Here are the details of your new website pool:</p>
        <hr class="h-px my-8 bg-gray-200 border-0">
        <ul class="text-left">
            <li> Name:</li>
            <li> Numbers Area Code:</li>
            <li> Forward Calls to:{{ $callForwarding }}</li>
            <li> Call Recording:</li>

        </ul>
    </div>

</div>
