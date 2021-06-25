<?php

namespace Ndeblauw\BlueAdmin\View\Components\Adminui;

use Illuminate\View\Component;

class ShowInfo extends Component
{
    public $label;

    public function __construct($label)
    {
        $this->label = $label;
    }

    public function render()
    {
        return view('BlueAdminUi::show-info');
    }
}
