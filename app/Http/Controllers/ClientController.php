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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ClientController extends Controller
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



        return view('admin.clients.index', compact('clients'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.clients.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @param \App\Http\Controllers\CreateClient $createClient
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request, CreateClient $createClient)
    {

        $createClient->handle($request);
        toastr()->success('client created successfully.');
        return redirect()->route('client.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('admin.clients.edit', compact('client'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
