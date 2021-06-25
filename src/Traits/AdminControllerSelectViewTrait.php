<?php

namespace Ndeblauw\BlueAdmin\Traits;

trait AdminControllerSelectViewTrait
{
    private function getView($type)
    {
        $VIEWPATH = $this->config->pathforAdminViews();

        switch ($type) {
            case 'index':
                return view()->exists($VIEWPATH.'.index') ? $VIEWPATH.'.index' : 'BlueAdminGeneric::index';

            case 'create':
                return view()->exists($VIEWPATH.'.create') ? $VIEWPATH.'.create' : 'BlueAdminGeneric::create';

            case 'show':
                return view()->exists($VIEWPATH.'.show') ? $VIEWPATH.'.show' : 'BlueAdminGeneric::show';

            case 'edit':
                return view()->exists($VIEWPATH.'.edit') ? $VIEWPATH.'.edit' : 'BlueAdminGeneric::edit';
        }
    }
}
