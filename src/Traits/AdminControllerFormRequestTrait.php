<?php

namespace Ndeblauw\BlueAdmin\Traits;

use Illuminate\Foundation\Http\FormRequest;

trait AdminControllerFormRequestTrait
{
    private function getFormRequestObjectName(): string
    {
        return 'App\\Http\\Requests\\'.$this->config->modelname().'Request';
    }

    private function getValidatedRequestObject(): FormRequest
    {
        return app($this->getFormRequestObjectName());
    }
}
