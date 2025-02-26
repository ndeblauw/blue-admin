<?php

namespace Ndeblauw\BlueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Ndeblauw\BlueAdmin\Models\Filepond;
use Ndeblauw\BlueAdmin\Traits\AdminControllerBelongsToManyTrait;
use Ndeblauw\BlueAdmin\Traits\AdminControllerFilepondTrait;
use Ndeblauw\BlueAdmin\Traits\AdminControllerFormRequestTrait;
use Ndeblauw\BlueAdmin\Traits\AdminControllerPrefillTrait;
use Ndeblauw\BlueAdmin\Traits\AdminControllerReturnPathTrait;
use Ndeblauw\BlueAdmin\Traits\AdminControllerSelectViewTrait;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    use AdminControllerReturnPathTrait;
    use AdminControllerPrefillTrait;
    use AdminControllerSelectViewTrait;
    use AdminControllerFormRequestTrait;
    use AdminControllerFilepondTrait;
    use AdminControllerBelongsToManyTrait;

    const CONFIG = null;

    protected $config;
    private $filepond;
    protected ?string $return_path = null;

    public function __construct(Filepond $filepond)
    {
        $this->filepond = $filepond;

        $configObject = (static::CONFIG !== null) ? static::CONFIG : $this->findConfigClass();
        $this->config = new $configObject;
    }

    public function index()
    {
        $this->policyCheck('viewAny');

        if($this->config->getUseAjaxIndex()) {
            return view($this->getView('index_api'))
                ->with('config', $this->config)
                ->with('actions_col_nr', count($this->config->getIndexTableColumns()));
        }

        $models = ($this->config->CLASS)::all();
        $models->load($this->config->getIndexLoadList());

        return view($this->getView('index'), compact('models'))->with('config', $this->config);
    }

    public function create(Request $request)
    {
        $this->setReturnPathSessionVariable();

        $this->policyCheck('create');

        if ($this->dealWithPrefillInputs($request)) {
            $parameters = $this->extractNonPrefillParameters($request);

            return redirect($this->config->getCreateUrl($parameters));
        }

        return view($this->getView('create'))->with('config', $this->config);
    }

    public function store(Request $request)
    {
        // Check if the user has the right to store a new record
        $this->policyCheck('create');

        // A - Validate the request data
        $request = $this->getValidatedRequestObject();
        $valid = $request->validated();

        // B - Preparations for dealing with  relations
        $filepond = $this->filepondPreparations($valid);
        $belongsToMany = $this->belongsToManyPreparations($valid);

        // C - Create the new record
        $model = ($this->config->CLASS)::create($valid);

        // D1 - Deal with relations - belongsToMany
        foreach ($belongsToMany as $key => $values) {
            $model->$key()->sync($values);
        }

        // D2 - Deal with relations - mediafiles
        foreach ($filepond as $key => $fileset) {
            foreach ($fileset as $file) {
                $model->addMedia($this->filepond->getPathFromServerId($file))->toMediaCollection($key);
            }
        }

        return redirect($this->return_path ?? $this->getReturnPath('create', $model->id));
    }

    public function show(int $id)
    {
        $model = ($this->config->CLASS)::findOrFail($id);
        $model->load($this->config->getShowLoadList());

        $this->policyCheck('view', $model);

        $attributesToShow = $this->config->getAttributesToShow()
            ?? array_diff(array_keys($model->getAttributes()), ['deleted_at', 'created_at', 'updated_at', 'tenant_id', 'iid']);

        return view($this->getView('show'), compact('model'))
            ->with('attributesToShow', $attributesToShow)
            ->with('config', $this->config);
    }

    public function edit(int $id)
    {
        $this->setReturnPathSessionVariable($id);
        $model = ($this->config->CLASS)::findOrFail($id);

        $this->policyCheck('update', $model);

        return view($this->getView('edit'), compact('model'))
            ->with('config', $this->config);
    }

    public function update(Request $request, int $id)
    {
        // A - Validate the request data
        $request = $this->getValidatedRequestObject();
        $valid = $request->validated();

        // B - Preparations for dealing with  relations
        $filepond = $this->filepondPreparations($valid);
        $belongsToMany = $this->belongsToManyPreparations($valid);

        // C - Update the model, check user rights & update
        $model = ($this->config->CLASS)::findOrFail($id);
        $this->policyCheck('update', $model);
        $model->update($valid);

        // D1 - Deal with relations - belongsToMany
        foreach ($belongsToMany as $key => $values) {
            $model->$key()->sync($values);
        }

        // D2 - Deal with relations - mediafiles
        foreach ($filepond as $key => $fileset) {
            $listExistingFiles = $model->getMedia($key)->pluck('id')->toArray();
            $toKeep = [];
            $newOrder = [];
            foreach ($fileset as $file) {
                if (substr($file, 0, 14) === 'existing_file_') {
                    // Already existing file? Add it to keep list
                    $toKeep[] = substr($file, 14);
                    $newOrder[] = substr($file, 14);
                } else {
                    // New upload? Add it to the collection
                    $newMediaFile = $model->addMedia($this->filepond->getPathFromServerId($file))->preservingOriginal()->toMediaCollection($key);
                    $newOrder[] = $newMediaFile->id;
                }
            }
            // Remove (existing files) that were deleted
            foreach (array_diff($listExistingFiles, $toKeep) as $idToDetach) {
                $model->getMedia($key)->where('id', $idToDetach)->first()->delete();
            }
            \Spatie\MediaLibrary\MediaCollections\Models\Media::setNewOrder($newOrder);
        }

        return redirect($this->return_path ?? $this->getReturnPath('edit', $id));
    }

    public function destroy(int $id)
    {
        $model = ($this->config->CLASS)::findOrFail($id);

        $this->policyCheck('delete', $model);

        $model->delete();

        $previous = Str::of(url()->previous());
        $return = (is_numeric( (string) $previous->afterLast('/'))) ? $previous->beforeLast('/') : $previous;

        return redirect($this->return_path ?? $return);
    }

    private function findConfigClass(): string
    {
        $this_controller_class = get_class($this);

        $config_class = Str::of($this_controller_class)->afterLast('\\')->remove('Controller')->start('App\\BlueAdmin\\');

        return (string) $config_class;
    }

    protected function policyCheck(string $ability, ?Model $model = null): void
    {
        // Do not check for policies if they are disabled for this model
        if (!$this->config->usePolicy() ) {
            return;
        }

        // If the policy doesn't exist, we can't check it (but issue warning)
        $class = $this->config->CLASS;
        $policy = 'app'.DIRECTORY_SEPARATOR.'Policies'.DIRECTORY_SEPARATOR.class_basename($class).'Policy.php';

        if (!file_exists(base_path($policy))) {
            Log::warning('Policies enabled, but no <strong>'.$policy.'</strong> found for <strong>'.$class.'</strong>.');

            $permission = Str::of($this->config->CLASS)->afterLast('\\')->snake().'-'.$ability;
            if(Permission::where('name', $permission)->exists()) {
                Log::warning('But good backup found, as permission exists: <strong>'.$permission.'</strong>, so checking with that');
                if( ! auth()->user()->can($permission) ) {
                    abort(403, 'You are not allowed to perform this action.');
                }
            }

            return;
        }

        // Call the authorise method on the policy, with the model or the class depending on the situation
        if($model) {
            $this->authorize($ability, $model);
        } else {
            $this->authorize($ability, $this->config->CLASS);
        }
    }
}
