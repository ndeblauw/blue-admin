<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{session()->get('tenant_name', config('app.name', 'schoolPoDiUm'))}}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://kit.fontawesome.com/2d1659a0a3.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css?5') }}">

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
<body class="font-sans antialiased">

<div class="h-screen overflow-hidden bg-gray-100">

    <div class="flex flex-cols h-full">
        <x-ba-admin-sidebar/>

        <div class="flex-grow overflow-auto">
            <x-ba-admin-breadcrumbs/>

            <!-- Page Content -->
            <main class="max-w-7xl flex-grow p-6">
                {{ $slot }}
            </main>

        </div>
    </div>
</div>
@livewireScripts
@stack('blueadmin_scripts')
</body>
</html>
