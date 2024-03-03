<!DOCTYPE html>
    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @vite(['resources/css/app.css','resources/js/app.js'])

        @livewireStyles

        @stack('styles')

    </head>

    <body class="bg-gray-50 dark:bg-gray-800">
                
        <!-- <div role="status" class="z-10 absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" >
            <svg aria-hidden="true" class="w-20 h-20 text-gray-200 animate-spin dark:text-gray-600 fill-black dark:fill-white" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g transform="rotate(30 50 50)" style="transform:matrix(0.866025, 0.5, -0.5, 0.866025, 31.6987, -18.3013);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="0.166667" style="opacity:0.166667;" ></rect></g>
                <g transform="rotate(60 50 50)" style="transform:matrix(0.5, 0.866025, -0.866025, 0.5, 68.3013, -18.3013);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="0.25" style="opacity:0.25;" ></rect></g>
                <g transform="rotate(90 50 50)" style="transform:matrix(0, 1, -1, 0, 100, 0);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="0.333334" style="opacity:0.333334;" ></rect></g>
                <g transform="rotate(120 50 50)" style="transform:matrix(-0.5, 0.866025, -0.866025, -0.5, 118.301, 31.6987);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="0.416667" style="opacity:0.416667;" ></rect></g>
                <g transform="rotate(150 50 50)" style="transform:matrix(-0.866025, 0.5, -0.5, -0.866025, 118.301, 68.3013);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="0.5" style="opacity:0.5;" ></rect></g>
                <g transform="rotate(180 50 50)" style="transform:matrix(-1, 0, 0, -1, 100, 100);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="0.583334" style="opacity:0.583334;" ></rect></g>
                <g transform="rotate(210 50 50)" style="transform:matrix(-0.866025, -0.5, 0.5, -0.866025, 68.3013, 118.301);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="0.666667" style="opacity:0.666667;" ></rect></g>
                <g transform="rotate(240 50 50)" style="transform:matrix(-0.5, -0.866025, 0.866025, -0.5, 31.6987, 118.301);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="0.75" style="opacity:0.75;" ></rect></g>
                <g transform="rotate(270 50 50)" style="transform:matrix(0, -1, 1, 0, 0, 100);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="0.833334" style="opacity:0.833334;" ></rect></g>
                <g transform="rotate(300 50 50)" style="transform:matrix(0.5, -0.866025, 0.866025, 0.5, -18.3013, 68.3013);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="0.916667" style="opacity:0.916667;" ></rect></g>
                <g transform="rotate(330 50 50)" style="transform:matrix(0.866025, -0.5, 0.5, 0.866025, -18.3013, 31.6987);" ><rect x="47" y="24" rx="3" ry="6" width="6" height="12"  opacity="1" style="" ></rect></g></svg>
            <span class="sr-only">Loading...</span>
        </div> -->
        @include('partials.header')

        <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

            @include('partials.sidebar')
 
            <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-16 lg:mx-2 dark:bg-gray-900">
           
                {{ $slot }}

            </div>

        </div>

        @include('partials.modules')

        @livewireScripts
        
        @stack('scripts')

    </body>
</html>