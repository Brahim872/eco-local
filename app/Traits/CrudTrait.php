<?php

namespace App\Traits;

use App\Actions\Admin\User\UpdateClient;
use App\Http\Requests\Admin\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

trait CrudTrait
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $view = $this->getView('backend.' . $this->prefixName . '.form')

            ->with('action',route($this->prefixName.'.store'));
        return $view;
    }


    public function store(Request $request)
    {


        $attr =  $this->beforeSave($request->except('_token'), (new $this->model));


        if(isset($attr['errors'])){
            toastr()->error($attr['errors']);
            return redirect()->back()->withInput($request->all());
        }

        $saveModel = (new $this->model)->create($attr);



        if ($saveModel) {
            $this->afterSave($request->all(), $saveModel);
        }

        toastr()->success('resource created successfully.');
        return redirect()->route($this->prefixName . '.index');
    }

    /**
     * After save Model
     *
     * @param array $attributes
     * @param BaseModel $model
     * @return void
     */
    protected function afterSave(array $attributes, $model)
    {

    }

    /**
     * Before save Model
     *
     * @param array $attributes
     * @param $model
     * @return array
     */
    protected function beforeSave(array $attributes, $model)
    {
        return $attributes;
    }

    public function update(Request $request,$id)
    {

        $attr =  $this->beforeSave($request->except('_token'), (new $this->model));


        if(isset($attr['errors'])){
            toastr()->error($attr['errors']);
            return redirect()->back()->withInput($request->all());
        }

        $saveModel = (new $this->model)->find($id)->update($attr);




        if ($saveModel) {
            $this->afterSave($request->all(), $saveModel);
        }

        toastr()->success('resource created successfully.');
        return redirect()->route($this->prefixName . '.index');
    }


    public function edit($slug)
    {
        $model = $this->model::where('slug', $slug)->firstOrFail();

        $view = $this->getView('backend.' . $this->prefixName . '.form');
        return $view->with('model', $model)
            ->with('action',route($this->prefixName.'.update',$model->id));
    }


    public function destroy($id)
    {
        $result = $this->model::findOrFail($id);
        $result->delete();

        toastr()->success($this->prefixName . 'deleted_successfully.');
        return redirect()->route($this->prefixName . '.index');
    }

    public function show($user)
    {

        $model = $this->model::where('slug', $user)->first();
        $view = $this->getView('backend.' . $this->prefixName . '.show');

        return $view->with('model', $model);

    }


}
