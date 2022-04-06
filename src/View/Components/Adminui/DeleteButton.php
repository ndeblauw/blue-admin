<?php

namespace Ndeblauw\BlueAdmin\View\Components\Adminui;

use Illuminate\View\Component;

class DeleteButton extends Component
{
    public $action;
    public $buttonText;

    public function __construct(string $action = '', ?string $buttonText = null)
    {
        $this->action = $action;
        $this->buttonText = $buttonText ?? __('Delete');
    }

    public function render()
    {
        return view('BlueAdminUi::button-delete');
    }
}
