<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full bg-gray-100 @if(config('app.env') !== 'production') border-l-4 border-red-500 @endif">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(config('blue-admin.favicon', false))
        <link rel="icon" href="{{ asset(config('blue-admin.favicon')) }}" type="image/x-icon"/>
    @endif

    <title>{{session()->get('tenant_name', config('app.name', 'blueAdmin'))}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="{{config('blue-admin.font.include', 'https://fonts.bunny.net/css?family=nunito')}}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2d1659a0a3.js" crossorigin="anonymous"></script>

    <!-- Styles & scripts -->
    @if(config('blue-admin.vite', false))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>
    @endif
    
    @if(config('blue-admin.livewire_v3', false))
        <!-- nothing -->
    @else
        @livewireStyles
    @endif

    @if(config('blue-admin.flux', false) && (config('blue-admin.flux-version','v1') == 'v1'))
        @fluxStyles
    @endif

    <style>
        [x-cloak] {
            display: none; /* remove flicker on page load */
        }
        #sidebar::-webkit-scrollbar {
            width: 0px;
            background: transparent; /* make scrollbar transparent */
        }
    </style>

    @if( App::environment('production') && config('blue-admin.fathom_site_id', false) )
        <script src="https://cdn.usefathom.com/script.js" data-site="{{config('blue-admin.fathom_site_id')}}" defer></script>
    @endif
    
    @stack('blueadmin_header')
</head>
<body class="font-sans antialiased h-full" style="font-family: '{{config('blue-admin.font.family', 'Nunito')}}'">
@if (Session::has('loginas') )
    <div class="border-b border-lime-400 bg-lime-100 py-4 text-center text-black">
        <i class="fa fa-exclamation-triangle text-lime-400"></i>&nbsp;
        You are impersonating another user (<span class="font-bold">{{auth()->user()->name}}</span>).
        Don't forget to log out when ready!&nbsp;&nbsp;
        <a class="rounded bg-lime-400 p-1 text-white" href="{{route('stoploginas', 1)}}"><i class="fas fa-sign-in-alt"></i>&nbsp;Back to Admin</a>
    </div>
@endif
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

@if(config('blue-admin.livewire_v3', false))
    @livewireScripts {{-- Always include to have AlpineJs  --}}
@else
    @livewireScripts
@endif

@if(config('blue-admin.flux', false))
    @fluxScripts
    <flux:toast />
@endif

                
@stack('blueadmin_scripts')
</body>
</html>
