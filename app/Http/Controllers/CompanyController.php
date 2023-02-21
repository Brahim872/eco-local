<?php

namespace App\Http\Controllers;


use App\Actions\Admin\Companies\CreateCompany;
use App\Actions\Admin\Companies\UpdateCompany;
use App\Http\Requests\Admin\StoreCompanyRequest;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use App\Traits\CrudTrait;
use App\Traits\DataTableTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{


    use CrudTrait;
    use DataTableTrait;

    protected $prefixName = "company";
    protected $model = Company::class;


    protected $columns = [
        'id' => [
            'title' => '#',
            'searchable' => false,
        ],
        'name' => [
            'title' => 'name',
            'filterKey' => 'name',
        ]
    ];


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
            'users' => User::select(['id', 'name'])->role('company')->get()->pluck('name', 'id'),
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
