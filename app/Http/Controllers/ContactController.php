<?php

namespace App\Http\Controllers;


use App\Helpers\Tools;
use App\Imports\ContactsImport;
use App\Models\Company;
use App\Models\Contact;
use App\Traits\CrudTrait;
use App\Traits\DataTableTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SplFileInfo;

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
            'select' => 'id',
            'from' => 'contacts',
            'filterKey' => 'contacts.id',
            'sortable' => 'contacts.id',
        ],
        'first_name' => [
            'title' => 'contact.first_name',
            'select' => 'first_name',
            'from' => 'contacts',
            'filterKey' => 'contacts.first_name',
            'sortable' => 'contacts.first_name',
        ],
        'last_name' => [
            'title' => 'contact.last_name',

            'select' => 'last_name',
            'from' => 'contacts',
            'filterKey' => 'contacts.last_name',
            'sortable' => 'contacts.last_name',
        ],
        'email' => [
            'title' => 'contact.email',
            'select' => 'email',
            'from' => 'contacts',
            'filterKey' => 'contacts.last_name',
            'sortable' => 'contacts.last_name',
        ],
        'name' => [
            'title' => 'contact.company_id',
            'select' => 'name',
            'from' => 'bs_companies',
            'filterKey' => 'bs_companies.name',
            'sortable' => 'bs_companies.name',
            'link' => 'company.show',
            'parameterLink' => 'slug as hide_slug',
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
//
//                'companies' => ['company_id',Company::whereHas("contact")->select(['id', 'name'])->get()->pluck('name','id')],
//                'contacts' => ['email',Contact::select(['email', 'email'])->get()->pluck('email', 'email')],
//
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
            'companies' => Company::select(['id', 'name'])->get()->pluck('name', 'id'),
            'contacts' => $contacts,
        ];
    }

    /**
     * Check that the given file is a valid file instance.
     *
     * @param mixed $file
     * @return bool
     */
    protected function isValidFile($file)
    {
        return $file instanceof SplFileInfo && $file->getPath() !== '';
    }

    public function store(Request $request)
    {
        $attr = $this->beforeSave($request->except('_token'));

        if (isset($attr['errors'])) {
            toastr()->error($attr['errors']);
            return redirect()->back()->withInput($request->all());
        }

        foreach ($attr as $number => $item) {
            $saveModel = (new $this->model)->updateOrCreate(['email' => $item['email'], 'company_id' => $item['company_id']], $item);
        }

        toastr()->success('resource created successfully.');
        return redirect()->route($this->prefixName . '.index');
    }


    protected function beforeSave($attributes)
    {
        if (isset($attributes['content']) && $this->isValidFile($attributes['content'])) {

            $errors = array();
            $element = Excel::toArray(new ContactsImport, $attributes['content']);

            $attributes = collect($element[0])->map(function ($row) use ($attributes) {
                $row['company_id'] = $attributes['company_id'];
                return $row;
            })->toArray();

            foreach ($attributes as $number => $lines) {
                if (!Tools::validateEmail($lines['email'])) {
                    $errors["errors"] = 'error format email in line : ' . $number + 1;
                }
            }

            if ($errors) {
                return $errors;
            };
            return $attributes;

        }

        if (isset($attributes['content'])) {

            $contents = array();
            $errors = array();

            foreach (explode(PHP_EOL, $attributes['content']) as $number => $lines) {
                if (!Tools::validateEmail(explode(',', $lines)[0])) {
                    $errors["errors"] = 'error format email in line : ' . $number + 1;
                }

                $contents[] = array(
                    'company_id' => $attributes['company_id'],
                    'email' => explode(',', $lines)[0],
                    'first_name' => explode(',', $lines)[1] ?? null,
                    'last_name' => explode(',', $lines)[2] ?? null,
                );

            }
            if ($errors) {
                return $errors;
            };
            return $contents;

        } else if (isset($attributes['email'])) {
            return $attributes;
        } else {
            $errors["errors"] = 'email is required';
            return $errors;
        }


    }

}
