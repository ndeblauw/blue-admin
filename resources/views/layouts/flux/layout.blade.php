<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full bg-gray-100 @if(config('app.env') !== 'production') border-x-4 border-red-500 @endif">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(config('blue-admin.favicon', false))
        <link rel="icon" href="{{ asset(config('blue-admin.favicon')) }}" type="image/x-icon"/>
    @endif

    <title>{{$title}} | {{session()->get('tenant_name', config('app.name', 'blueAdmin'))}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2d1659a0a3.js" crossorigin="anonymous"></script>

    <!-- Styles & scripts -->
    <style>[x-cloak] {display: none; /* remove flicker on page load */}</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if(config('blue-admin.flux-version') === 'v1')
        @fluxStyles
    @endif

    @if( App::environment('production') && config('blue-admin.fathom_site_id', false) )
        <script src="https://cdn.usefathom.com/script.js" data-site="{{config('blue-admin.fathom_site_id')}}" defer></script>
    @endif

    @stack('blueadmin_header')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800" style="font-family: Inter">

<x-ba-fluxadmin-header/>

{{-- only in case of mobile --}}
<flux:sidebar stashable sticky class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="px-2 dark:hidden" />
    <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="px-2 hidden dark:flex" />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>
        <flux:navlist.item icon="inbox" badge="12" href="#">Inbox</flux:navlist.item>
        <flux:navlist.item icon="document-text" href="#">Documents</flux:navlist.item>
        <flux:navlist.item icon="calendar" href="#">Calendar</flux:navlist.item>

        <flux:navlist.group expandable heading="Favorites" class="max-lg:hidden">
            <flux:navlist.item href="#">Marketing site</flux:navlist.item>
            <flux:navlist.item href="#">Android app</flux:navlist.item>
            <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
    </flux:navlist>
</flux:sidebar>
{{--end mobile --}}

<flux:main container>
    <div class="flex max-md:flex-col items-start">

        {{-- Custom defined navlist from within view that calls this template --}}
        @if( isset($navlist) && $navlist )
            <div class="w-full md:w-[220px] pb-4 mr-10">
                {{$navlist}}
                <flux:navlist>
                    <flux:navlist.item href="#" current>Dashboard</flux:navlist.item>
                    <flux:navlist.item href="#" badge="32">Orders</flux:navlist.item>
                    <flux:navlist.item href="#">Catalog</flux:navlist.item>
                    <flux:navlist.item href="#">Payments</flux:navlist.item>
                    <flux:navlist.item href="#">Customers</flux:navlist.item>
                    <flux:navlist.item href="#">Billing</flux:navlist.item>
                    <flux:navlist.item href="#">Quotes</flux:navlist.item>
                    <flux:navlist.item href="#">Configuration</flux:navlist.item>
                </flux:navlist>
            </div>
            <flux:separator class="md:hidden" />
        @endif

        {{-- Auto generated navlist from informatio in defined menu --}}
        @if($showSidebar && !isset($navlist) && $sidebar )
        <div class="w-full md:w-[220px] shrink-0 pb-4 mr-10">
            <flux:navlist>
                @foreach($sidebar as $label => $link)
                    @if($link !== '---')
                        <flux:navlist.item href="/{{$link}}" :current="str($current_route)->contains($link)">{{$label}}</flux:navlist.item>
                    @else
                        <flux:separator variant="subtle"  class="my-4"/>
                    @endif
                @endforeach
            </flux:navlist>
        </div>
        @endif

        <div class="flex-1 max-md:pt-6 self-stretch mb-6">

            @if($showTitle && $title)
                <flux:heading size="xl" level="1">{{$title}}</flux:heading>

                @if($subtitle)
                    <flux:subheading size="lg" class="mb-2">{{$subtitle}}</flux:subheading>
                @endif
                <flux:separator />
            @endif

            {{$slot}}

        </div>
    </div>
</flux:main>
@stack('blueadmin_scripts')
@fluxScripts
</body>
</html>
