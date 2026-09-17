<?php

namespace Ndeblauw\BlueAdmin\Tests;

use Ndeblauw\BlueAdmin\BlueAdminServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            BlueAdminServiceProvider::class,
        ];
    }
}
