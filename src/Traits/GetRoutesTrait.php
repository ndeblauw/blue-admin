<?php

namespace Ndeblauw\BlueAdmin\Traits;

trait GetRoutesTrait
{
    public function getBackOrIndexUrl()
    {
        return session()->get('blueadmin.returnpath', $this->getIndexUrl());
    }

    public function getIndexUrl(): string
    {
        return route('admin.'.$this->routename().'.index');
    }

    public function getCreateUrl($parameters = null): string
    {
        return route('admin.'.$this->routename().'.create', $parameters);
    }

    public function getStoreUrl(): string
    {
        return route('admin.'.$this->routename().'.store');
    }

    public function getShowUrl($id): string
    {
        return route('admin.'.$this->routename().'.show', [strtolower($this->modelname()) => $id]);
    }

    public function getEditUrl($id): string
    {
        return route('admin.'.$this->routename().'.edit', [strtolower($this->modelname()) => $id]);
    }

    public function getUpdateUrl($id): string
    {
        return route('admin.'.$this->routename().'.update', [strtolower($this->modelname()) => $id]);
    }

    public function getDestroyUrl($id): string
    {
        return route('admin.'.$this->routename().'.destroy', [strtolower($this->modelname()) => $id]);
    }
}
