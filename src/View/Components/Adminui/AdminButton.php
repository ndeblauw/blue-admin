<?php

namespace Ndeblauw\BlueAdmin\View\Components\Adminui;

use Illuminate\View\Component;

class AdminButton extends Component
{
    public $href;

    public function __construct($href = '')
    {
        $this->href = $href;
    }

    public function render()
    {
        return view('BlueAdminUi::admin-button');
    }
}
