<?php

namespace Ndeblauw\BlueAdmin\View\Components\Adminlayout;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    public ?array $sidebar;
    public ?string $current_route;

    public function __construct(
        public ?string $title = null,
        public ?string $subtitle = null,
        public ?bool $showTitle = true,
        public ?bool $showSidebar = true,
    ) {}

    public function render()
    {
        $this->sidebarMenuGenerator();

        return config('blue-admin.flux-layout', false)
            ? view('BlueAdminLayouts::flux.layout')
            : view('BlueAdminLayout::admin-layout');
    }

    private function sidebarMenuGenerator()
    {
        $current_top_level_menu_item = $this->findActiveTopLevelMenuItem();

        $menu = collect(config('blue-admin.fluxmenu.top'))->filter( fn($item) => $item['link'] === $current_top_level_menu_item)->first();

        $this->sidebar = $menu !== null && array_key_exists('sidebar', $menu)
            ? $menu['sidebar']
            : null;
    }

    private function findActiveTopLevelMenuItem()
    {
        $this->current_route = Route::current()->uri;
        $routename = Route::currentRouteName();

        $fake_index_routename = str($routename)->replace(['show', 'create', 'edit'], 'index')->toString();
        $current_route = Str::of($fake_index_routename)->contains('.index') && Route::has($fake_index_routename)
            ? str(route($fake_index_routename))->replace(config('app.url').'/','')->toString()
            : Route::current()->uri; // todo - make more fault tolerant !!! (https etc)

        // Check if it was one of the top level routes
        $top_routes = collect(config('blue-admin.fluxmenu.top'))->map( fn($item) => $item['link'])->filter(fn($item) => $current_route == $item);

        if( $top_routes->isNotEmpty()){
            return $current_route;
        }

        // Check if it was one of the sidebar routes of a toproute
        $list = collect(config('blue-admin.fluxmenu.top'))
            ->filter( fn($item) => array_key_exists('sidebar', $item))
            ->map( fn($item) => collect($item['sidebar'])->map( fn($l,$k) => ['sidebar' => $l, 'topmenu' => $item['link']]))
            ->values()->flatten(1);

        //ray($list)->label('List of routes');
        //ray($current_route)->label('current route');
        //ray($list->filter( fn($item) => $item['sidebar'] == $current_route)->first())->label('selected route');

        $element = $list->where('sidebar', $current_route)->first();
        if(array_key_exists('topmenu', $element ?? [] )) {
            return $element['topmenu'];
        }

        return null;
    }
}
