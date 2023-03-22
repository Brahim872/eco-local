<?php

namespace App\Http\Controllers;


use App\Actions\Admin\Companies\CreateCompany;
use App\Actions\Admin\Companies\UpdateCompany;
use App\Actions\Admin\Products\UpdateProduct;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Models\Campaign;
use App\Models\City;
use App\Models\Company;
use App\Models\User;
use App\Traits\CrudTrait;
use App\Traits\DataTableTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CampaignController extends Controller
{


    use CrudTrait;
    use DataTableTrait;

    protected $prefixName = "campaign";
    protected $currentRequest = "";
    protected $model = Campaign::class;
    protected $withAction = true;


    protected $listFilter;

    protected $columns = [
        'id' => [
            'title' => '#',
            'filterKey' => 'id',
            'sortable' => 'id',
        ],
        'name' => [
            'title' => 'company.name',
            'filterKey' => 'name',
            'sortable' => 'name',
            'link' => 'company.show',
            'parameterLink' => 'slug'
        ],
        'website' => [
            'title' => 'company.website',
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

//        $this->listFilter = [
//            'name' => (array)(new $this->model)->select(['name'])->get()->toArray(),
//        ];
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

}
