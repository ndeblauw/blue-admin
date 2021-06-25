<?php

namespace Ndeblauw\BlueAdmin\Traits;

trait AdminControllerBelongsToManyTrait
{
    public function belongsToManyPreparations(&$valid)
    {
        $belongsToMany = [];

        if (property_exists($this->config, 'belongsToMany')) {
            foreach ($this->config->belongsToMany as $key) {
                if (array_key_exists($key, $valid)) {
                    $belongsToMany[$key] = $valid[$key];
                    unset($valid[$key]);
                } else {
                    $belongsToMany[$key] = [];
                }
            }
        }

        return $belongsToMany;
    }
}
