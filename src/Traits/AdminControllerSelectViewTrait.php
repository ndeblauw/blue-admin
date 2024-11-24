<?php

namespace Ndeblauw\BlueAdmin\Traits;

trait AdminControllerSelectViewTrait
{
    private function getView($type)
    {
        $version = config('blue-admin.flux', false) ? 'flux' : 'old';

        $CUSTOMVIEWPATH = $this->config->pathforAdminViews();

        return view()->exists("$CUSTOMVIEWPATH.$type") ? "$CUSTOMVIEWPATH.$type" : "BlueAdminGeneric::$version.$type";
    }
}
