<?php

namespace Ndeblauw\BlueAdmin\View\Layouts\FluxAdmin;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Header extends Component
{
    public array $menu;
    public array $logo;
    public string $current_route;

    public function __construct()
    {
        $this->logo = [
            'image' =>  $image = config('blue-admin.fluxlayout.logo.image', null),
            'image_dark' => config('blue-admin.fluxlayout.logo.darkimage',$image),
            'link' => config('blue-admin.fluxlayout.logo.link', config('app.url')),
            'name' => config('blue-admin.fluxlayout.logo.name', ''),
        ];
        
        $this->menu = config('blue-admin.fluxmenu.top');
    }

    public function render()
    {
        $this->current_route = $this->findActiveTopLevelMenuItem();

        return view('BlueAdminLayouts::flux.header');
    }

    public function findActiveTopLevelMenuItem()
    {
        $routename = Route::currentRouteName();
        $fake_index_routename = str($routename)->replace(['show', 'create', 'edit'], 'index')->toString();
        $current_route = Route::has($fake_index_routename)
            ? str(route($fake_index_routename))->replace(config('app.url').'/','')->toString()
            : Route::current()?->uri;

        // Check if it was one of the top level routes
        $top_routes = collect(config('blue-admin.fluxmenu.top'))->map( fn($item) => $item['link'])->filter(fn($item) => $current_route == $item);

        if( $top_routes->isNotEmpty()){
            return $current_route;
         }

        // Check if it was one of the sidebar routes of a toproute
        $list = collect(config('blue-admin.fluxmenu.top'))
            ->filter( fn($item) => array_key_exists('sidebar', $item))
            ->map( fn($item) =>
            collect($item['sidebar'])->map( fn($l,$k) => ['sidebar' => $l, 'topmenu' => $item['link']])
            )->values()->flatten(1);

        //ray($list)->label('List of routes');
        //ray($current_route)->label('current route');
        //ray($list->filter( fn($item) => $item['sidebar'] == $current_route)->first())->label('selected route');

        $element = $list->where('sidebar', $current_route)->first();
        if(array_key_exists('topmenu', $element ?? [] )) {
            return $element['topmenu'];
        }

        return '';
    }
}
