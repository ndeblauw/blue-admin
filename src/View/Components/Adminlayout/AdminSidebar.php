<?php

namespace Ndeblauw\BlueAdmin\View\Components\Adminlayout;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class AdminSidebar extends Component
{
    private $menu;

    public function __construct()
    {
        $this->menu = config('blue-admin.menu');
    }

    public function render()
    {
        $route = Route::current();

        $annotatedMenu = $this->annotateActive($this->menu, $route->uri);

        return view('BlueAdminLayout::admin-sidebar')
            ->with('menu', json_decode(json_encode($annotatedMenu, false)));
    }

    private function annotateActive($menu, $uri)
    {
        $value = preg_replace('/\/\{[\s\S]+?\}/', '', $uri); // allow detection for all resource routes

        $value = str_replace('/edit', '', $value);
        $value = str_replace('/create', '', $value);
        $value = str_replace('/for-season', '', $value);

        foreach ($menu as &$item) {
            $open = false;

            if (isset($item['submenu'])) {
                foreach ($item['submenu'] as &$subitem) {
                    if ($subitem['link'] == $value) {
                        $subitem['active'] = true;
                        $open = true;
                        break;
                    }
                }
            } else {
                if ($item['link'] == $value) {
                    $item['active'] = true;
                    break;
                }
            }

            if ($open) {
                $item['open'] = true;
                break;
            }
        }

        return $menu;
    }
}
