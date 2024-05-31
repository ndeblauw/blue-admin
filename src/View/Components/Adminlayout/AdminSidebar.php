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
            $item['hidden'] = false;
            if(isset($item['color'])) {
                $item['bg_color'] = "bg-{$item['color']}-50";
                $item['icon_color_active'] = "text-{$item['color']}-200";
                $item['icon_color'] = "text-{$item['color']}-400";
            } else {
                $item['bg_color'] = "bg-blue-50";
                $item['icon_color_active'] = "text-blue-200";
                $item['icon_color'] = "text-gray-400";
            }
        }

        foreach ($menu as &$item) {
            $open = false;

            if(isset($item['permission'])) {
                if(!auth()->user()->hasPermissionTo($item['permission'])) {
                    $item['hidden'] = true;
                }
            }
            
            if(isset($item['header'])) {
                continue;
            }

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
                    continue;
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
