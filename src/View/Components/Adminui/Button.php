<?php

namespace Ndeblauw\BlueAdmin\View\Components\Adminui;

use Illuminate\View\Component;

class Button extends Component
{
    public $action;
    public $buttonText;

    public function __construct(string $action = '', ?string $buttonText = null)
    {
        $this->action = $action;
        $this->buttonText = $buttonText ?? __('Update');
    }

    public function render()
    {
        return view('BlueAdminUi::button');
    }
}
