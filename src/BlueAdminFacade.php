<?php

namespace Ndeblauw\BlueAdmin;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ndeblauw\BlueAdmin\Skeleton\SkeletonClass
 */
class BlueAdminFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'blue-admin';
    }
}
