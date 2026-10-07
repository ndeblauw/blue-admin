<?php

namespace Ndeblauw\BlueAdmin\Tests;

use Ndeblauw\BlueAdmin\BlueAdmin;
use Ndeblauw\BlueAdmin\FormDataBinder;

class SmokeTest extends TestCase
{
    public function test_it_registers_the_package_bindings()
    {
        $this->assertInstanceOf(BlueAdmin::class, $this->app->make('blue-admin'));
        $this->assertInstanceOf(FormDataBinder::class, $this->app->make(FormDataBinder::class));
    }

    public function test_it_registers_package_routes_and_views()
    {
        $this->assertTrue($this->app['router']->has('filepond.upload'));
        $this->assertTrue($this->app['router']->has('blueadmin.api.index'));
        $this->assertTrue(view()->exists('BlueAdminLivewire::rte-editor'));
    }
}
