<?php

namespace App\Http\Controllers;



use App\Actions\Admin\Companies\CreateCompany;
use App\Actions\Admin\Companies\UpdateCompany;
use App\Http\Requests\Admin\StoreCompanyRequest;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Product;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{


    use CrudTrait;

    protected $prefixName = "company";
    protected $model = Company::class;


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $Companys = (new Company)->newQuery();

        if (request()->has('search')) {
            $Companys->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $Companys->orderBy($attribute, $sort_order);
        } else {
            $Companys->latest();
        }

        $model = $Companys->paginate(5)->onEachSide(2);


        return view('admin.Company.index', compact('model'));
    }
    /**
     * Define view vars
     *
     * @return array
     */


    protected function getViewVars()
    {

        $contacts = DB::table('bs_contactes')
            ->where('contact_type','=','App\Models\Client')
            ->join('bs_clients','bs_clients.id','=','bs_contactes.contact_id')

        ;
        return [
            'admin' => $this->model::with('users')->first(),
            'contacts' => $contacts,
        ];
    }


    public function storeCompany(StoreCompanyRequest $request, CreateCompany $createCompany)
    {

        return $this->store($request, $createCompany);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyRequest $request
     * @param Company $Company
     * @param UpdateProduct $updateCompany
     * @return RedirectResponse
     */
    public function updateCompany(UpdateCompanyRequest $request, $Company, UpdateCompany $updateCompany)
    {
        $Company = Company::findOrFail($Company);
        return $this->update($request, $Company, $updateCompany);
    }


}
