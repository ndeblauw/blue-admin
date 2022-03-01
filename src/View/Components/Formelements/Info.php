<?php

namespace Ndeblauw\BlueAdmin\View\Components\Formelements;

use Illuminate\View\Component;

class Info extends Component
{
    public $label;
    public $value;
    public $comment;
    public $name = 'nn';
    public $required = false;

    public function __construct($label, $value, $comment = '')
    {
        $this->label = $label;
        $this->value = $value;
        $this->comment = $comment;
    }

    public function render()
    {
        return view('components.formelements.info');
    }
}
