<?php

namespace Ndeblauw\BlueAdmin\Models;

use Illuminate\Support\Str;
use Ndeblauw\BlueAdmin\Traits\GetRoutesTrait;

class BlueAdminModel
{
    use GetRoutesTrait;

    public $has_policy = false;

    public function modelname()
    {
        return substr($this->CLASS, strrpos($this->CLASS, '\\') + 1);
    }

    public function pathforAdminViews()
    {
        // TODO: enable setting it explicitly and then use that value
        return 'admin.'.strtolower(Str::plural($this->modelname()));
    }

    public function routename()
    {
        return strtolower(Str::plural($this->modelname()));
    }

    public function titleField()
    {
        return property_exists($this, 'title_field') ? $this->title_field : 'title';
    }
    
    /* ==|STUFF FOR INDEX VIEW|======================================================== */
    public function getIndexLoadList()
    {
        return property_exists($this, 'index_load') ? $this->index_load : [];
    }
    
    public function getIndexTableColumns()
    {
        return property_exists($this, 'indexTableColumns') ? $this->indexTableColumns : ['title'];
    }

    /* ==|STUFF FOR SHOW VIEW|========================================================= */
    public function getShowLoadList()
    {
        return property_exists($this, 'show_load') ? $this->show_load : [];
    }

    public function getAttributesToShow()
    {
        return property_exists($this, 'attributesToShow') ? $this->attributesToShow : null;
    }
}
