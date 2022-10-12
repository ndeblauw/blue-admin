<?php

namespace Ndeblauw\BlueAdmin\Traits;

trait AdminControllerSelectViewTrait
{
    private function getView($type)
    {
        $VIEWPATH = $this->config->pathforAdminViews();

        return match($type) {
            'index' => view()->exists($VIEWPATH.'.index') ? $VIEWPATH.'.index' : 'BlueAdminGeneric::index',


            'create' => view()->exists($VIEWPATH.'.create') ? $VIEWPATH.'.create' : 'BlueAdminGeneric::create',

            'show' => view()->exists($VIEWPATH.'.show') ? $VIEWPATH.'.show' : 'BlueAdminGeneric::show',

            'edit' => view()->exists($VIEWPATH.'.edit') ? $VIEWPATH.'.edit' : 'BlueAdminGeneric::edit',
        };
    }
}
