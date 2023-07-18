<?php

namespace Ndeblauw\BlueAdmin\Traits;

use Illuminate\Support\Facades\Session;

trait AdminControllerReturnPathTrait
{
    private function setReturnPathSessionVariable($id = null): void
    {
        // remove get parameters, if any
        $previousUrl = substr(
            url()->previous(),
            0,
            strpos(url()->previous(), '?') ?: strlen(url()->previous())
        );

        if ($id === null && $this->config->getCreateUrl() === $previousUrl) {
            return;
        }

        if ($id !== null && $this->config->getEditUrl($id) === $previousUrl) {
            return;
        }

        Session::put('blueadmin.returnpath', str_replace(url('/'), '', url()->previous()));
    }

    private function getReturnPath($from = null, $id = null): string
    {
        if( isset($this->return_path) ) {
            return $this->return_path;
        }

        if ($from === 'create' && property_exists($this->config, 'afterCreate')) {
            return match($this->config->afterCreate) {
                'index' => $this->config->getIndexUrl(),
                'show' => $this->config->getShowUrl($id),
            };
        }

        if ($from === 'edit' && property_exists($this->config, 'afterEdit')) {
            return match($this->config->afterEdit) {
                'index' => $this->config->getIndexUrl(),
                'show' => $this->config->getShowUrl($id),
            };
        }

        return Session::get('blueadmin.returnpath', $this->config->getIndexUrl());
    }
}
