<?php

namespace App\Http\Controllers;

use App\Actions\Admin\Clients\UpdateProduct;
use App\Actions\Admin\User\CreateUser;
use App\Actions\Admin\User\UpdateUser;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdatePasswordUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use CrudTrait;

    protected $prefixName = "user";
    protected $model = User::class;

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = (new User)->newQuery();

        if (request()->has('search')) {
            $users->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $users->orderBy($attribute, $sort_order);
        } else {
            $users->latest();
        }

        $users = $users->paginate(5)->onEachSide(2);


        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }


    public function storeUser(StoreUserRequest $request, CreateUser $createUser)
    {
        return $this->store($request, $createUser);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show($user)
    {
        $user = User::where('slug', $user)->firstOrFail();
        $roles = Role::all();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');

        return view('admin.user.show', compact('user', 'roles', 'userHasRoles'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit($id)
    {
        $user = User::where('slug', $id)->firstOrFail();
        $roles = Role::all();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');

        return view('admin.user.edit', compact('user', 'roles', 'userHasRoles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @param UpdateProduct $updateUser
     * @return RedirectResponse
     */

    public function updateUser(UpdateUserRequest $request, $user, UpdateUser $updateUser)
    {
        $client = User::findOrFail($user);
        return $this->update($request, $client, $updateUser);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePasswordUserRequest $request
     * @param User $user
     * @param UpdateProduct $updateUser
     * @return RedirectResponse
     */
    public function updatePassword(UpdatePasswordUserRequest $request, $user, UpdateProduct $updateUser)
    {
        $user = User::where('slug', $user)->firstOrFail();
        $updateUser->changePassword($request, $user);
        toastr()->success('User updated successfully.');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy($user)
    {
        $user = User::where('slug', $user)->firstOrFail();
        $user->delete();

        toastr()->success('User deleted successfully.');
        return redirect()->route('user.index');
    }


}
