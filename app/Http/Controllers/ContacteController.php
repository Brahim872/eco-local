<?php

namespace App\Http\Controllers;


use App\Actions\Admin\Companies\CreateContacte;
use App\Actions\Admin\Companies\UpdateContacte;
use App\Http\Requests\Admin\StoreContacteRequest;
use App\Http\Requests\Admin\UpdateContacteRequest;
use App\Models\Contacte;
use App\Models\Product;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ContacteController extends Controller
{


    use CrudTrait;

    protected $prefixName = "contact";
    protected $model = Contacte::class;


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $Contactes = (new Contacte)->newQuery();

        if (request()->has('search')) {
            $Contactes->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }

            $Contactes->orderBy($attribute, $sort_order);
        } else {
            $Contactes->latest('bs_contactes.id');
        }

        $model = $Contactes->where('contact_type', '=', 'App\Models\Company')
            ->join('bs_companies', 'bs_companies.id', '=', 'bs_contactes.contact_id')
            ->paginate(5)
            ->onEachSide(2);


        return view('admin.' . $this->prefixName . '.index', compact('model'));
    }

    /**
     * Define view vars
     *
     * @return array
     */


    protected function getViewVars()
    {

        $contacts = DB::table('bs_contactes')
            ->where('contact_type', '=', 'App\Models\Client')
            ->join('bs_clients', 'bs_clients.id', '=', 'bs_contactes.contact_id');
        return [
            'admin' => $this->model::with('users')->first(),
            'contacts' => $contacts,
        ];
    }


    public function storeContacte(StoreContacteRequest $request, CreateContacte $createContacte)
    {

        return $this->store($request, $createContacte);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContacteRequest $request
     * @param Contacte $Contacte
     * @param UpdateProduct $updateContacte
     * @return RedirectResponse
     */
    public function updateContacte(UpdateContacteRequest $request, $Contacte, UpdateContacte $updateContacte)
    {
        $Contacte = Contacte::findOrFail($Contacte);
        return $this->update($request, $Contacte, $updateContacte);
    }


}
