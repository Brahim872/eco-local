<?php

namespace App\Http\Controllers;


use App\Actions\Admin\Companies\CreateCompany;
use App\Actions\Admin\Companies\UpdateCompany;
use App\Helpers\Tools;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Models\City;
use App\Models\Company;
use App\Models\User;
use App\Traits\CrudTrait;
use App\Traits\DataTableTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{


    use CrudTrait;
    use DataTableTrait;

    protected $prefixName = "company";
    protected $currentRequest = "";
    protected $model = Company::class;
    protected $withAction = true;


    protected $listFilter;

    protected $columns = [
        'id' => [
            'title' => '#',
            'select'=>'id',
            'from'=>'bs_companies',
            'filterKey' => 'id',
            'sortable' => 'id',
        ],

        'profile' => [
            'title' => '',
            'isImage' => true,
            'select'=>'profile',
            'from'=>'bs_companies',
            'class'=>'column_avatar',
        ],
        'name' => [
            'title' => 'company.name',
            'select'=>'name',
            'from'=>'bs_companies',
            'filterKey' => 'name',
            'sortable' => 'name',
            'link' => 'company.show',
            'parameterLink' => 'slug as hide_slug'

        ],
        'website' => [
            'title' => 'company.website',
            'select'=>'website',
            'from'=>'bs_companies',
            'filterKey' => 'website',
            'sortable' => 'website',
        ],
        'slug' => [
            'title' => 'company.slug',
            'display' => false,
        ]
    ];


    public function __construct(Request $request)
    {
        $this->currentRequest = $request;
        $this->listFilter = [
            'name' => (array)(new $this->model)->select(['name'])->get()->toArray(),
        ];
    }





    protected function beforeSave(array $attributes, $model)
    {
        $file = $this->currentRequest->file('image');
        if (isset($attributes['image']) && Tools::isValidFile($attributes['image'])) {
            $extension = $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('images/'.$this->prefixName, $file, uniqid().'.'.$extension);
            $attributes['profile'] = $path;

        }else{

            $attributes['profile'] =  $this->currentRequest->profile;
        }


        return $attributes;
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
            'backend' => $this->model::with('users')->first(),
            'users' => User::select(['id', 'name'])->role('company')->get()->pluck('name', 'id'),
            'cities' => City::select(['id', 'name'])->get()->pluck('name', 'id'),
            'contacts' => $contacts,
        ];
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
