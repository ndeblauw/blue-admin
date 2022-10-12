<?php


namespace Ndeblauw\BlueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ApiIndexController extends Controller
{
    const CONFIG = null;

    protected $config;

    public function __invoke($modelname)
    {
        $this->setConfig($modelname);

        //$mapperBelongsTo = $this->config->index_columns()->where('type', 'belongsto')->values();
        //$mapperBelongsToMany = $this->config->index_columns()->where('type', 'belongsToMany')->values();

        //$preloadRelations = array_merge($mapperBelongsTo->pluck('value')->toArray(), $mapperBelongsToMany->pluck('value')->toArray());

        //$model = $this->config->CLASS::/*with($preloadRelations)->*/select($modelname.'.*')->take(50);
        $model = $this->config->CLASS::query()->take(50);

        /*foreach($this->config->index_scopes as $scope) {
            $model = $model->{$scope}();
        }*/

        $datatablesObject = DataTables::eloquent($model);

/*        foreach($mapperBelongsTo as $map) {
            $datatablesObject->addColumn($map->value, function ($item) use ($map) {
                $key = $map->value;
                $field = $map->field;
                return $item->$key->$field;
            });
        }*/

/*        foreach($mapperBelongsToMany as $map) {
            $datatablesObject->addColumn($map->value, function ($item) use ($map) {
                $key = $map->value;
                $field = $map->field;
                return $item->$key->pluck($field)->implode(', ');
            });
        }*/

        return $datatablesObject->toJson();
    }

    private function setConfig($modelname)
    {
        $CLASS = '\App\\BlueAdmin\\' . ucfirst( Str::singular($modelname));
        $this->config = new $CLASS;
    }


}
