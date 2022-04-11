<?php

namespace Ndeblauw\BlueAdmin\View\Components;

use Illuminate\Support\Facades\Session;
use Illuminate\View\Component as BaseComponent;

abstract class Component extends BaseComponent
{
    use HandlesBoundModel;

    const TEMPLATE = '';
    const REQUIRED = '<span class="text-blue-500">*</span>';
    const DISABLED = ' disabled';
    const SIZE = 'w-full md:w-1/2';

    public string $name;
    public string $id;
    public string $label;
    public string $placeholder;
    public string $comment;
    public string $required;
    public string $size;
    public string $disabled;
    public $model;
    public $value;

    public function __construct($name, $label, $placeholder, $id, $comment, $required, $size, $value, $disabled = false, $bind = null)
    {
        // If ?prefil[name]=xxx in url, prefill the field - only if no value was explicitly given
        $prefill = Session::get('prefill', false);
        if (is_null($value) && $prefill) {
            $value = array_key_exists($name, $prefill) ? $prefill[$name] : $value;
        }

        $this->name = $name;
        $this->label = $label ?? ucfirst($name);
        $this->placeholder = $placeholder ?? '';
        $this->id = $id ?? $name;
        $this->comment = $comment ?? '';

        $this->required = $required ? $this::REQUIRED : '';
        $this->size = $size === null ? $this::SIZE : $size;

        $this->disabled = $disabled ? $this::DISABLED : '';

        if (basename(request()->path()) == 'create') {
            $this->value = $value;
        } else {
            $this->model = $this->getBoundTarget();
            $this->value = $value ?: $this->getBoundValue($name,$bind);
        }
    }

    public function render()
    {
        $template = property_exists($this, 'template') ? ($this->template ?? static::TEMPLATE) : static::TEMPLATE;

        return view('BlueAdminFormelements::'.$template);
    }

    protected function getOptionsFromSource(string $source = null)
    {
        if ($source === null) {
            abort(500, 'Either options or source needs to be set to use <x-ba-radiobuttons');
        }

        $Source = 'BlueAdminFormelements::'.$source;

        return $Source::getSelectValues();
    }
}
