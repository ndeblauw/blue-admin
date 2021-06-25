<?php

namespace Ndeblauw\BlueAdmin\View\Components\Formelements;

use Ndeblauw\BlueAdmin\View\Components\Component;

class Radiobuttons extends Component
{
    const TEMPLATE = 'radiobuttons';

    public $options;
    public $inline;

    public function __construct(
        string $name,
        string $label = null,
        string $comment = null,
        string $id = null,
        bool $required = false,
        bool $disabled = false,
        string $size = null,
        string $value = null,
        bool $inline = false,

        $options = null,
        $source = null
    ) {
        parent::__construct($name, $label, null, $id, $comment, $required, $size, $value, $disabled);
        $this->inline = (bool) $inline;
        $this->options = $options ?? $this->getOptionsFromSource($source);
    }
}
