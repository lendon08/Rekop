<!DOCTYPE html>
    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css','resources/js/app.js'])

        @livewireStyles

        @stack('styles')

    </head>

    <body class="bg-gray-50 dark:bg-gray-800">
        
        @include('partials.header')

        <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

            @include('partials.sidebar')

            <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
                
                {{ $slot }}

            </div>

        </div>

        @include('partials.modules')

        @livewireScripts
        
        @stack('scripts')



    </body>
</html>