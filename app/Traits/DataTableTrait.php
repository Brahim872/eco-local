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

        return view('backend.' . $this->prefixName . '.index')
            ->with('columns', $this->columns)
            ->with('prefixName', $this->prefixName)
            ->with('withAction', $this->withAction??null);
    }


    public function getSelect($select)
    {
        $ele = [];

        foreach ($select as $key => $item) {


            if(isset($item['parameterLink']) ){
                if(isset($item['from'])){
                    $ele[] = $item['from'].'.'.$item['parameterLink'];
                }else{
                    $ele[] = $item['parameterLink'];
                }
            }

            if(!isset($item['display']) || $item['display']==true){

                if(isset($item['select'])){
                    if (isset($item['as'])){
                        $ele[] = $item['from'].'.'. $item['select'].' as '.$item['as'];
                    }else{
                        $ele[] =  $item['from'].'.'.$item['select'];
                    }
                }else{
                    $ele[] =  $key;
                }
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


    public function initJoins()
    {
        if (isset($this->innerJoin)) {

            foreach ( $this->innerJoin as $join ) {

                $this->dataTable = $this->dataTable
                    ->join($join[0],$join[1],$join[2]);


            }
        }
        if (isset($this->leftJoin)) {

            foreach ( $this->leftJoin as $join ) {

                $this->dataTable = $this->dataTable
                    ->leftJoin($join[0],$join[1],$join[2]);


            }
        }
    }

    public function initOrderBy()
    {
        $keys = array_keys($this->columns);
        $first_key = $this->columns[$keys[0]]['sortable'];

        if ($this->currentRequest->sort && $this->currentRequest->sort['dir']) {
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

        $this->initJoins();
        $this->initFilter();
        $this->initSearch();
        $this->initOrderBy();

        $this->dataTable = $this->dataTable->paginate($this->currentRequest->pagination??10)->toArray();


        $output = [

            'filter' => view('partials.table.filter')
                ->with('listFilter', $this->listFilter??[])
                ->render(),

            'table' =>$this->prefixName,

            'data' => view('partials.table.table')
                ->with('dataTable', $this->dataTable)
                ->with('columns', $this->columns)
                ->with('prefixName', $this->prefixName)
                ->with('withAction', $this->withAction??NULL)
                ->render(),
        ];

        return response()->json($output);
    }


}
