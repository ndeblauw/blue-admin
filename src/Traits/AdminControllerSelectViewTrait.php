<?php

namespace Ndeblauw\BlueAdmin\Traits;

trait AdminControllerSelectViewTrait
{
    private function getView($type)
    {
        $VIEWPATH = $this->config->pathforAdminViews();

        return match($type) {
            'index' => view()->exists($VIEWPATH.'.index') ? $VIEWPATH.'.index' : 'BlueAdminGeneric::index',

            'index_api' => view()->exists($VIEWPATH.'.index_api') ? $VIEWPATH.'.index_api' : 'BlueAdminGeneric::index_api',

            'create' => view()->exists($VIEWPATH.'.create') ? $VIEWPATH.'.create' : 'BlueAdminGeneric::create',

            'show' => view()->exists($VIEWPATH.'.show') ? $VIEWPATH.'.show' : 'BlueAdminGeneric::show',

            'edit' => view()->exists($VIEWPATH.'.edit') ? $VIEWPATH.'.edit' : 'BlueAdminGeneric::edit',
        };
    }
}
