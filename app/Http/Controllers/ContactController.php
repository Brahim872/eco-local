<?php

namespace App\Http\Controllers;


use App\Actions\Admin\Companies\CreateCompany;
use App\Actions\Admin\Companies\UpdateCompany;
use App\Helpers\Tools;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Models\City;
use App\Models\Company;
use App\Models\Contact;
use App\Traits\CrudTrait;
use App\Traits\DataTableTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContactController extends Controller
{


    use CrudTrait;
    use DataTableTrait;

    protected $prefixName = "contact";
    protected $currentRequest = "";
    protected $model = Contact::class;
    protected $withAction = true;


    protected $listFilter;
    protected $innerJoin = [
        ['bs_companies', 'bs_companies.id', 'contacts.company_id']
    ];

    protected $columns = [
        'id' => [
            'title' => '#',
            'filterKey' => 'contacts.id',
            'sortable' => 'contacts.id',
            'table' => 'contacts'
        ],
        'first_name' => [
            'title' => 'contact.first_name',
            'filterKey' => 'contacts.first_name',
            'sortable' => 'contacts.first_name',
            'table' => 'contacts'
        ],
        'last_name' => [
            'title' => 'contact.last_name',
            'filterKey' => 'contacts.last_name',
            'sortable' => 'contacts.last_name',
            'table' => 'contacts'
        ],
        'email' => [
            'title' => 'contact.email',
            'filterKey' => 'contacts.last_name',
            'sortable' => 'contacts.last_name',
            'table' => 'contacts'
        ],
        'name' => [
            'title' => 'contact.company_id',
            'filterKey' => 'bs_companies.name',
            'sortable' => 'bs_companies.name',
            'link' => 'company.show',
            'parameterLink' => 'bs_companies.slug',
            'table' => 'bs_companies'
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
            'companies' => (array)Company::select(['id', 'name'])->get()->toArray(),
        ];
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
            'companies' => Company::select(['id', 'name'])->get()->pluck('name', 'id'),
            'contacts' => $contacts,
        ];
    }


    protected function beforeSave(array $attributes, $model)
    {
        if (isset($attributes['content'])) {

            $contents = array();
            $errors = array();
            foreach (explode(PHP_EOL, $attributes['content']) as $number=>$lines) {

                if (!Tools::validateEmail(explode(',', $lines)[0])){
                    $errors["errors"] = 'error format email in line : '.$number+1 ;
                    ;
                }

                $contents[] = array(
                    'company_id' => $attributes['company_id'],
                    'email' => explode(',', $lines)[0],
                    'first_name' => explode(',', $lines)[1]??null,
                    'last_name' => explode(',', $lines)[2]??null,
                );
            }
            if($errors){
                return $errors;
            };
            return $contents;

        }else{
            return $attributes;
        }
    }

}
