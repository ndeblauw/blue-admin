<?php

namespace Ndeblauw\BlueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Ndeblauw\BlueAdmin\Models\Filepond;
use Ndeblauw\BlueAdmin\Traits\AdminControllerBelongsToManyTrait;
use Ndeblauw\BlueAdmin\Traits\AdminControllerFilepondTrait;
use Ndeblauw\BlueAdmin\Traits\AdminControllerFormRequestTrait;
use Ndeblauw\BlueAdmin\Traits\AdminControllerPrefillTrait;
use Ndeblauw\BlueAdmin\Traits\AdminControllerReturnPathTrait;
use Ndeblauw\BlueAdmin\Traits\AdminControllerSelectViewTrait;

class AdminController extends Controller
{
    use AdminControllerReturnPathTrait;
    use AdminControllerPrefillTrait;
    use AdminControllerSelectViewTrait;
    use AdminControllerFormRequestTrait;
    use AdminControllerFilepondTrait;
    use AdminControllerBelongsToManyTrait;

    protected $config;
    private $filepond;

    public function __construct(Filepond $filepond)
    {
        $this->filepond = $filepond;

        $configObject = static::CONFIG;
        $this->config = new $configObject;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = ($this->config->CLASS)::all();

        return view($this->getView('index'), compact('models'))->with('config', $this->config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->setReturnPathSessionVariable();

        if ($this->dealWithPrefillInputs($request)) {
            $parameters = $this->extractNonPrefillParameters($request);

            return redirect($this->config->getCreateUrl($parameters));
        }

        return view($this->getView('create'))->with('config', $this->config);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        return redirect($this->getReturnPath('create', $model->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = ($this->config->CLASS)::findOrFail($id);
        $model->load($this->config->getShowLoadList());

        $attributesToShow = $this->config->getAttributesToShow()
            ?? array_diff(array_keys($model->getAttributes()), ['deleted_at', 'created_at', 'updated_at', 'tenant_id', 'iid']);

        return view($this->getView('show'), compact('model'))
            ->with('attributesToShow', $attributesToShow)
            ->with('config', $this->config);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->setReturnPathSessionVariable($id);
        $model = ($this->config->CLASS)::findOrFail($id);

        return view($this->getView('edit'), compact('model'))
            ->with('config', $this->config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // A - Validate the request data
        $request = $this->getValidatedRequestObject();
        $valid = $request->validated();

        // B - Preparations for dealing with  relations
        $filepond = $this->filepondPreparations($valid);
        $belongsToMany = $this->belongsToManyPreparations($valid);

        // C - Update the model
        $model = ($this->config->CLASS)::findOrFail($id);
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

        return redirect($this->getReturnPath('edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ($this->config->CLASS)::findOrFail($id);
        if ($this->config->has_policy) {
            Gate::authorize('delete', $model);
        }
        $model->delete();

        return redirect($this->config->getIndexUrl());
    }
}
