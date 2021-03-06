<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full bg-gray-100 @if(config('app.env') !== 'production') border-l-4 border-red-500 @endif">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{session()->get('tenant_name', config('app.name', 'blueAdmin'))}}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://kit.fontawesome.com/2d1659a0a3.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

@livewireStyles

<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <style>
        [x-cloak] {
            display: none; /* remove flicker on page load */
        }
        #sidebar::-webkit-scrollbar {
            width: 0px;
            background: transparent; /* make scrollbar transparent */
        }
    </style>
    @stack('blueadmin_header')
</head>
<body class="font-sans antialiased h-full">
<div>

    <!-- Static sidebar for desktop -->
    <x-ba-admin-sidebar/>


    <div class="md:pl-64 flex flex-col flex-1">

        <div class="sticky top-0 z-10 md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-gray-100">
            <button type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Open sidebar</span>
                <!-- Heroicon name: outline/menu -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div class="flex-1">
            <x-ba-admin-breadcrumbs/>

            <!-- Page Content -->
            <main class="max-w-7xl flex-grow px-4 sm:px-6 md:px-8 mt-4 mb-12">
                {{ $slot }}
            </main>

        </div>
    </div>
</div>

@livewireScripts
@stack('blueadmin_scripts')
</body>
</html>
