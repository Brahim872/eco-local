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


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $Companys = (new $this->model)->newQuery();

        if (request()->has('search')) {
            foreach ($this->columns as $key => $column) {
                if (isset($column['filterKey'] )) {
                    $Companys->where($column['filterKey'], 'Like', '%' . request()->input('search') . '%');
                }
            }
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

}
