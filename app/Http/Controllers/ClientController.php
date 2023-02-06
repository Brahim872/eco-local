<?php

namespace App\Http\Controllers;


use App\Actions\Admin\Clients\CreateClient;
use App\Http\Requests\Admin\StoreClientRequest;
use App\Http\Requests\Admin\UpdateClientRequest;
use App\Models\Client;
use App\Models\Product;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
            $clients->where('name', 'Like', '%' . request()->input('search') . '%');
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

        $model = $clients->paginate(5)->onEachSide(2);


        return view('admin.client.index', compact('model'));
    }
    /**
     * Define view vars
     *
     * @return array
     */


    protected function getViewVars()
    {
        return [
            'admin' => $this->model::with('users')->with('products')->firstOrfail(),
            'products' => Product::all(),
        ];
    }


    public function storeClient(StoreClientRequest $request, CreateClient $createClient)
    {

        return $this->store($request, $createClient);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param Client $client
     * @param UpdateProduct $updateClient
     * @return RedirectResponse
     */
    public function updateClient(UpdateClientRequest $request, $client, UpdateClient $updateClient)
    {
        $client = Client::findOrFail($client);
        return $this->update($request, $client, $updateClient);
    }


}
