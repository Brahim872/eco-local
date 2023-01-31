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
        return view('admin.' . $this->prefixName . '.create');
    }


    public function store(Request $request, $service)
    {

        $service->handle($request);
        toastr()->success('resource created successfully.');
        return redirect()->route($this->prefixName . '.index');
    }

    public function update($request, $client, $service)
    {
        $service->handle($request, $client);
        toastr()->success('resource updated successfully.');
        return redirect()->route($this->prefixName . '.index');
    }


    public function edit($slug)
    {
        $model = $this->model::where('slug', $slug)->firstOrFail();

        $view = $this->getView('admin.' . $this->prefixName . '.edit');
        return $view->with('model', $model);
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
        $model = $this->model::where('slug', $user)->firstOrFail();
        $view = $this->getView('admin.' . $this->prefixName . '.show');
        return $view->with('model', $model);

    }


}
