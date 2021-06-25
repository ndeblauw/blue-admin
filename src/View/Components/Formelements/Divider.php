<?php

namespace Ndeblauw\BlueAdmin\View\Components\Formelements;

use Illuminate\View\Component;

class Divider extends Component
{
    public $subtitle;

    public function __construct(string $subtitle = null)
    {
        $this->subtitle = $subtitle;
    }

    public function render()
    {
        return view('BlueAdminFormelements::divider');
    }
}
