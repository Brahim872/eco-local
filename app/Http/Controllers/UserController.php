<?php

namespace App\Http\Controllers;

use App\Actions\Admin\User\CreateClient;
use App\Actions\Admin\User\CreateUser;
use App\Actions\Admin\User\UpdateClient;
use App\Actions\Admin\User\UpdateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdatePasswordUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{


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
            $users->where('name', 'Like', '%'.request()->input('search').'%');
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
     * @return Response
     */
    public function create()
    {

        $roles = Role::all();
        return view('admin.user.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @param CreateClient $createUser
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request, CreateUser $createUser)
    {

        $createUser->handle($request);
        toastr()->success('User created successfully.');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show($user)
    {
        $user = User::findOrFail($user);
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');

        return view('admin.user.edit', compact('user', 'roles', 'userHasRoles'));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @param UpdateClient $updateUser
     * @return Response
     */
    public function update(UpdateUserRequest $request, $user, UpdateUser $updateUser)
    {
        $user = User::findOrFail($user);
        $updateUser->handle($request, $user);
        toastr()->success('User updated successfully.');
        return redirect()->route('user.index');
    }




    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePasswordUserRequest $request
     * @param User $user
     * @param UpdateClient $updateUser
     * @return Response
     */
    public function updatePassword(UpdatePasswordUserRequest $request, $user, UpdateClient $updateUser)
    {
        $user = User::findOrFail($user);
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
        $user = User::findOrFail($user);
        $user->delete();

        toastr()->success('User deleted successfully.');
        return redirect()->route('user.index');
    }





}
