<?php

namespace Ndeblauw\BlueAdmin\View\Components\Formelements;

use Ndeblauw\BlueAdmin\View\Components\Component;

class Textarea extends Component
{
    const TEMPLATE = 'textarea';
    public bool $rte;
    public bool $h2h3;
    public int $rows;

    public function __construct(
        string $name,
        string $label = null,
        string $placeholder = null,
        string $comment = null,
        string $id = null,
        bool $required = false,
        bool $disabled = false,
        string $size = null,
        string $value = null,
        int $rows = 6,
        bool $rte = false,
        bool $h2h3 = false
    ) {
        parent::__construct($name, $label, $placeholder, $id, $comment, $required, $size, $value, $disabled);

        $this->rows = $rows;
        $this->rte = $rte;
        $this->h2h3 = $h2h3;
    }
}
