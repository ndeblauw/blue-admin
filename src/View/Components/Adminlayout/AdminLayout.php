<?php

namespace Ndeblauw\BlueAdmin\View\Components\Adminlayout;

use Illuminate\View\Component;

class AdminLayout extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('BlueAdminLayout::admin-layout');
    }
}
