<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />

    <flux:brand :href="$logo['link']" target="_blank" :logo="$logo['image']" :name="$logo['name']" class="max-lg:hidden dark:hidden" />
    <flux:brand :href="$logo['link']" :logo="$logo['image_dark']" target="_blank" :name="$logo['name']" class="max-lg:!hidden hidden dark:flex" />

    <flux:navbar class="-mb-px max-lg:hidden">
        @foreach($menu as $item)
            <flux:navbar.item icon="{{$item['icon']}}" href="/{{$item['link']}}" :current="$current_route == $item['link']">{{$item['label']}}</flux:navbar.item>
        @endforeach


        {{-- todo: implement favourites functionality for blueadmin
        <flux:separator vertical variant="subtle" class="my-2"/>

        <flux:dropdown class="max-lg:hidden">
            <flux:navbar.item icon-trailing="chevron-down">Favorites</flux:navbar.item>

            <flux:navmenu>
                <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
                <flux:navmenu.item href="#">Android app</flux:navmenu.item>
                <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown>
        --}}
    </flux:navbar>

    <flux:spacer />

    {{-- todo: implement these for blueadmin fluxlayouts
    <flux:navbar class="mr-4">
        <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
        <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />
        <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help" />
    </flux:navbar>
    --}}

    <flux:dropdown position="top" align="start">
        <flux:navbar.item icon-trailing="chevron-down">{{auth()->user()->name}}</flux:navbar.item>

        {{-- todo: include conditionally if there are avatars
        <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
        --}}

        <flux:menu>
            {{-- todo: remove this from blueadmin --}}
            <flux:menu.radio.group>
                <flux:menu.radio checked>Focus op mijn antenne</flux:menu.radio>
                <flux:menu.radio>Overkoepelend</flux:menu.radio>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <flux:menu.item href="{{route('admin.logout')}}" icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
        </flux:menu>
    </flux:dropdown>
</flux:header>