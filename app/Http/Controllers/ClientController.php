<?php

namespace App\Http\Controllers;

use App\Actions\Admin\Clients\CreateClient;
use App\Actions\Admin\User\UpdateClient;
use App\Actions\Admin\User\UpdateUser;
use App\Http\Requests\Admin\StoreClientRequest;
use App\Http\Requests\Admin\UpdateClientRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ClientController extends Controller
{


    use CrudTrait;

    protected $prefixName = "client";
    protected $model = Client::class;

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
        $clients = (new Client)->newQuery();

        if (request()->has('search')) {
            $clients->where('name', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $clients->orderBy($attribute, $sort_order);
        } else {
            $clients->latest();
        }

        $clients = $clients->paginate(5)->onEachSide(2);



        return view('admin.client.index', compact('clients'));
    }



    public function storeClient(StoreClientRequest $request, CreateClient $createClient)
    {
        return $this->store($request, $createClient);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param \App\Models\Client $client
     * @param UpdateClient $updateClient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, $client, UpdateClient $updateClient)
    {
        $user = Client::findOrFail($client);
        $updateClient->handle($request, $client);
        toastr()->success('Client updated successfully.');
        return redirect()->route('client.index');
    }



}
