<?php

namespace App\Http\Controllers;

use App\Actions\Admin\Products\CreateProduct;
use App\Actions\Admin\Products\UpdateProduct;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Client;
use App\Models\Product;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function Ramsey\Collection\element;

class ProductController extends Controller
{


    use CrudTrait;

    protected $prefixName = "product";
    protected $model = Product::class;

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
        $products = (new Product)->newQuery();

        if (request()->has('search')) {
            $products->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $products->orderBy($attribute, $sort_order);
        } else {
            $products->latest();
        }

        $model = $products->paginate(5)->onEachSide(2);


        return view('admin.product.index', compact('model'));
    }

    /**
     * Define view vars
     *
     * @return array
     */


    protected function getViewVars()
    {

        return [
            'model' => $this->model::firstOrfail()
        ];
    }


    public function storeProduct(StoreProductRequest $request, CreateProduct $createProduct)
    {

        return $this->store($request, $createProduct);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @param UpdateProduct $updateProduct
     * @return RedirectResponse
     */
    public function updateProduct(UpdateProductRequest $request, $product, UpdateProduct $updateProduct)
    {
        $product = Product::findOrFail($product);
        return $this->update($request, $product, $updateProduct);
    }


    public function switchStatus(Request $request)
    {

        $data_ = [];

        $client = Client::find($request->client_id);
        $product = Product::find($request->product_id);

        $client->products()->toggle($product->id);

        return response()->json([
            'status' => 200
        ]);

    }


}
