<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = (new Role)->newQuery();

        if (request()->has('search')) {
            $roles->where('name', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $roles->orderBy($attribute, $sort_order);
        } else {
            $roles->latest();
        }

        $roles = $roles->paginate(5)->onEachSide(2);

        return view('backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get()->groupBy('category');


        return view('backend.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());

        if (! empty($request->permissions)) {
            $role->givePermissionTo($request->permissions);
        }
        toastr()->success('Data has been saved successfully!');

        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');

        return view('backend.role.show', compact('role', 'permissions', 'roleHasPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($role)
    {
        $role = Role::findOrFail($role);
        $permissions = Permission::all();
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');

        return view('backend.role.edit', compact('role', 'permissions', 'roleHasPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $role)
    {

        $role= Role::findOrFail($role);
        $role->update($request->all());
        $permissions = $request->permissions ?? [];
        $role->syncPermissions($permissions);

        toastr()->success('Role updated successfully!');
        return redirect()->route('role.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        toastr()->success('Role deleted successfully!');
        return redirect()->route('role.index');
    }
}
