<?php

namespace App\Traits;

use App\Actions\Admin\User\UpdateClient;
use App\Http\Requests\Admin\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

trait DataTableTrait
{

    public $dataTable;

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {

        if ($this->currentRequest->ajax()) {
            return $this->createAjaxResponse();
        }

        return view('admin.' . $this->prefixName . '.index')
            ->with('columns', $this->columns);
    }


    public function getSelect($select)
    {
        $ele = [];

        foreach ($select as $key => $item) {

            if(isset($item['parameterLink']) ){
                $ele[] = $item['parameterLink'].' as hide_slug';
            }
            if(!isset($item['display']) || $item['display']==true){
                $ele[] = $key;
            }
        }

        return $ele;
    }

    public function initSearch()
    {
        if ($this->currentRequest->search) {
            foreach ($this->columns as $column) {
                if (isset($column['filterKey'])) {
                    $this->dataTable = $this->dataTable->orWhere($column['filterKey'], 'like', '%' . $this->currentRequest->search . '%');
                }

            }
        }
    }

    public function initFilter()
    {

        if ($this->currentRequest->filter) {

            foreach ($this->currentRequest->filter as $key=>$column) {

                    $this->dataTable = $this->dataTable
                        ->where($key, 'like', '%' . $column . '%');


            }
        }
    }

    public function initOrderBy()
    {
        $keys = array_keys($this->columns);
        $first_key = $keys[0];

        if ($this->currentRequest->sort) {
            $orderDir = $this->currentRequest->sort['dir'];
            $orderCol = $this->currentRequest->sort['col'];
        } else {
            $orderDir = 'DESC';
            $orderCol = $first_key;
        }

        $this->dataTable = $this->dataTable->orderBy($orderCol, $orderDir);
    }

    public function createAjaxResponse()
    {
        $select = $this->getSelect($this->columns);

        $this->dataTable = (new $this->model)
            ->select($select);

        $this->initFilter();
        $this->initSearch();
        $this->initOrderBy();


        $this->dataTable = $this->dataTable->paginate(5)->toArray();



        $output = [

            'filter' => view('partials.table.filter')
                ->with('listFilter', $this->listFilter??[])
                ->render(),

            'paginationInfo' => view('partials.table.pagination-info')
                ->with('pagination', $this->dataTable)
                ->render(),

            'pagination' => view('partials.table.pagination')
                ->with('pagination', $this->dataTable)
                ->render(),

            'data' => view('partials.table.body')
                ->with('dataTable', $this->dataTable)
                ->with('columns', $this->columns)
                ->render(),
        ];

        return response()->json($output);
    }


}
