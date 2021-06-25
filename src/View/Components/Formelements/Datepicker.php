<?php

namespace Ndeblauw\BlueAdmin\View\Components\Formelements;

use Ndeblauw\BlueAdmin\View\Components\Component;

class Datepicker extends Component
{
    const TEMPLATE = 'datepicker';
    public bool $onlyDate;
    public bool $onlyTime;
    public string $type;

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
        bool $onlyDate = false,
        bool $onlyTime = false
    ) {
        if ($onlyDate && $onlyTime) {
            abort(404, "You can't assign both onlyDate and onlyTime together...");
        }
        parent::__construct($name, $label, $placeholder, $id, $comment, $required, $size, $value, $disabled);
        $this->onlyDate = $onlyDate ? true : false;
        $this->onlyTime = $onlyTime ? true : false;

        $this->type = $onlyDate ? 'date' : ($onlyTime ? 'time' : 'datetime-local');

        $dateValue = \Carbon\Carbon::parse($this->value);

        switch ($this->type) {
            case 'date':
                $this->value = ($this->value) ? $dateValue->format('Y-m-d') : null;
                break;

            case 'time':
                $this->value = ($this->value) ? $dateValue->format('H:i') : null;
                break;

            default:
                $this->value = ($this->value) ? $dateValue->format('Y-m-d').'T'.$dateValue->format('H:i') : null;
                break;
        }
    }
}
