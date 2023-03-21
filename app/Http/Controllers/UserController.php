<?php

namespace App\Http\Controllers;

use App\Actions\Admin\Clients\UpdateProduct;
use App\Actions\Admin\User\CreateUser;
use App\Actions\Admin\User\UpdateUser;
use App\Helpers\Tools;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdatePasswordUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use App\Traits\CrudTrait;
use App\Traits\DataTableTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use CrudTrait;
    use DataTableTrait;

    protected $prefixName = "user";
    protected $model = User::class;
    protected $withAction = false;

    protected $columns = [
        'id' => [
            'title' => '#',
            'filterKey' => 'id',
            'sortable' => 'id',
        ],
        'profile' => [
            'title' => 'user.profile',
            'isImage' => true,
            'class'=>'column_avatar',
        ],
        'name' => [
            'title' => 'user.name',
            'filterKey' => 'name',
            'sortable' => 'name',
        ],

    ];
    /**
     * @var Request
     */
    private $currentRequest;


    public function __construct(Request $request)
    {

        $this->currentRequest = $request;
    }

    /**
     * Define view vars
     *
     * @return array
     */

    protected function getViewVars()
    {


        $roles = [];
        $roles = Role::select(['id', 'name'])->get()->pluck('name', 'id');
        if (Auth::user()->role('company')) {
            $roles = Role::select(['id', 'name'])->where('name', '!=', 'super-backend')->get()->pluck('name', 'id');
        }

        return [
            'roles' => $roles,
        ];
    }

    protected function beforeSave(array $attributes, $model)
    {
        $file = $this->currentRequest->file('image');
        if (Tools::isValidFile($attributes['image'])) {
            $extension = $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('images/users', $file, uniqid().'.'.$extension);
        }
        $attributes['profile'] = $path??null;

        return $attributes;
    }

    protected function afterSave(array $attributes, $model)
    {
        if (isset($attributes['roles'])) {
            $roles = $attributes['roles'] ?? 'company';
            $model->assignRole($roles);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public
    function show($user)
    {
        $user = User::where('slug', $user)->firstOrFail();
        $roles = Role::all();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');

        return view('backend.user.show', compact('user', 'roles', 'userHasRoles'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public
    function edit($id)
    {
        $user = User::where('slug', $id)->firstOrFail();
        $roles = Role::all();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');

        return view('backend.user.edit', compact('user', 'roles', 'userHasRoles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @param UpdateProduct $updateUser
     * @return RedirectResponse
     */

    public
    function updateUser(UpdateUserRequest $request, $user, UpdateUser $updateUser)
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
    public
    function updatePassword(UpdatePasswordUserRequest $request, $user, UpdateProduct $updateUser)
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
    public
    function destroy($user)
    {
        $user = User::where('slug', $user)->firstOrFail();
        $user->delete();

        toastr()->success('User deleted successfully.');
        return redirect()->route('user.index');
    }


}
