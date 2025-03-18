<!DOCTYPE html>
<html lang="{{ str_replace('-', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Page Title'}}</title>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        @vite(['resources/css/app.css','resources/js/app.js'])

        @livewireStyles

        @stack('styles')

    </head>

    <body class="bg-gray-50">


        {{-- @include('partials.header') --}}

        <div class="flex overflow-hidden bg-gray-50">

            @include('partials.sidebar')

            <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-16 lg:mx-2">

                {{ $slot }}

            </div>

        </div>

        @include('partials.modules')

        @livewireScripts

        @stack('scripts')
            {{-- <footer>J --}}
    </body>
</html>
