<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
        @livewireStyles
    </head>
    <body>
        <main class="h-screen">
            <!-- <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
                <a href="https://flowbite-admin-dashboard.vercel.app/" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                    <img src="https://flowbite-admin-dashboard.vercel.app/images/logo.svg" class="mr-4 h-11" alt="EzSEO Logo">
                    <span>EZSEO</span>  
                </a>
                
            </div> -->
            <div class="w-full h-full bg-white rounded-lg shadow">
                {{ $slot }}
            </div>
        </main>
        @livewireScripts
    </body>
</html>