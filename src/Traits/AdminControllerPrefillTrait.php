<?php

namespace Ndeblauw\BlueAdmin\Traits;

use Illuminate\Support\Facades\Session;

trait AdminControllerPrefillTrait
{
    private function dealWithPrefillInputs($request): bool
    {
        if ($request->missing('prefill')) {
            return false;
        }

        Session::flash('prefill', $request->prefill);

        return true;
    }

    private function extractNonPrefillParameters($request): array
    {
        $parameters = $request->all();
        unset($parameters['prefill']);

        return $parameters;
    }
}
