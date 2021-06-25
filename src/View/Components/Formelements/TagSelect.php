<?php

namespace Ndeblauw\BlueAdmin\View\Components\Formelements;

use Ndeblauw\BlueAdmin\View\Components\Component;

class TagSelect extends Component
{
    const TEMPLATE = 'tagselect';

    public $options;
    public $inline;
    public $allowNullOption;
    public $values;

    public function __construct(
        string $name,
        string $label = null,
        string $comment = null,
        string $id = null,
        bool $required = false,
        bool $disabled = false,
        string $size = null,
        array $values = null,
        bool $inline = false,
        bool $allowNullOption = false,

        $options = null,
        $source = null
    ) {
        parent::__construct($name, $label, null, $id, $comment, $required, $size, $disabled);

        if ($this->model !== null) {
            $this->values = $this->model->$name->pluck('id')->toArray();
        } else {
            $this->values = is_array($values) ? $values : [$values];
        }

        $this->inline = (bool) $inline;
        $this->allowNullOption = ($allowNullOption) ? true : false;
        $this->options = $options ?? $this->getOptionsFromSource($source);
    }
}
