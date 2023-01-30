<?php

namespace App\Traits;

use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

trait CrudTrait
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.'.$this->prefixName.'.create');
    }


    public function store(Request $request, $service)
    {

        $service->handle($request);
        toastr()->success('resource created successfully.');
        return redirect()->route($this->prefixName.'.index');
    }





    public function edit($id)
    {
        $client = $this->model::findOrFail($id);
        return view('admin.'.$this->prefixName.'.edit', compact('client'));
    }



    public function destroy($id)
    {
        $result = $this->model::findOrFail($id);
        $result->delete();

        toastr()->success($this->prefixName.'deleted_successfully.');
        return redirect()->route($this->prefixName.'.index');
    }
}
