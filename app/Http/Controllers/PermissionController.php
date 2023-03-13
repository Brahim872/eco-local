<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    public function __construct()
    {

    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $permissions = (new Permission)->newQuery();

        if (request()->has('search')) {
            $permissions->where('name', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $permissions->orderBy($attribute, $sort_order);
        } else {
            $permissions->latest();
        }

        $permissions = $permissions->paginate(5)->onEachSide(2);

        return view('backend.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('backend.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermissionRequest $request
     * @return RedirectResponse
     */
    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->all());
        toastr()->success('Permission created successfully!');
        return redirect()->route('permission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return Application|Factory|View
     */
    public function show($permission)
    {
        $permission = Permission::findOrFail($permission);
        return view('backend.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return Application|Factory|View
     */
    public function edit( $permission)
    {
        $permission = Permission::findOrFail($permission);
        return view('backend.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePermissionRequest $request
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function update(UpdatePermissionRequest $request, $permission)
    {
        $permission = Permission::findOrFail($permission);
        $permission->update($request->all());
        toastr()->success('Permission updated successfully!');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function destroy($permission)
    {
        $permission = Permission::findOrFail($permission);
        $permission->delete();
        toastr()->success('Permission deleted successfully!');
        return redirect()->route('permission.index');
    }
}
