<?php

namespace Ndeblauw\BlueAdmin\View\Components\Formelements;

use Ndeblauw\BlueAdmin\View\Components\Component;

class BelongsTo extends Component
{
    const TEMPLATE = 'select';
    public $template;
    public $options;
    public $allowNullOption;
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
        $options = null,
        $source = null,
        $allowNullOption = null,
        bool $inline = false,
        $template = null
    ) {
        $name = $name.'_id';
        parent::__construct($name, $label, null, $id, $comment, $required, $size, $value, $disabled);
        $this->options = $options ?? $this->getOptionsFromSource($source);
        $this->allowNullOption = (isset($allowNullOption)) ? true : false;
        $this->template = $template;
        $this->inline = (bool) $inline;
    }
}
