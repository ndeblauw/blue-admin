<?php

namespace Ndeblauw\BlueAdmin\Traits;

trait AdminControllerFilepondTrait
{
    public function filepondPreparations(&$valid)
    {
        $filepond = [];

        if (property_exists($this->config, 'filepond')) {
            foreach (($this->config->filepond) as $key) {
                if (array_key_exists($key, $valid)) {
                    $data = is_array($valid[$key]) ? $valid[$key] : [$valid[$key]];
                    $filepond[$key] = $data;
                    unset($valid[$key]);
                }
            }
        }

        return $filepond;
    }
}
