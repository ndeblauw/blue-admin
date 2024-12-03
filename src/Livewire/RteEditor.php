<?php

namespace Ndeblauw\BlueAdmin\Livewire;

use Livewire\Component;

class RteEditor extends Component
{
    public string $content = '';
    public string $name = '';

    public function render()
    {
        return view('BlueAdminLivewire::rte-editor');
    }
}
