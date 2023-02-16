<?php

namespace App\Http\Controllers;


use App\Actions\Admin\Campaigns\CreateCampaign;
use App\Http\Requests\Admin\StoreCampaignRequest;
use App\Http\Requests\Admin\UpdateCampaignRequest;
use App\Models\Campaign;
use App\Models\Product;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{


    use CrudTrait;

    protected $prefixName = "campaign";
    protected $model = Campaign::class;


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $Campaigns = (new Campaign)->newQuery();

        if (request()->has('search')) {
            $Campaigns->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $Campaigns->orderBy($attribute, $sort_order);
        } else {
            $Campaigns->latest();
        }

        $model = $Campaigns->paginate(5)->onEachSide(2);


        return view('admin.'.$this->prefixName.'.index', compact('model'));
    }
    /**
     * Define view vars
     *
     * @return array
     */


    protected function getViewVars()
    {



        return [

        ];
    }


    public function storeCampaign(StoreCampaignRequest $request, CreateCampaign $createCampaign)
    {

        return $this->store($request, $createCampaign);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCampaignRequest $request
     * @param Campaign $Campaign
     * @param UpdateProduct $updateCampaign
     * @return RedirectResponse
     */
    public function updateCampaign(UpdateCampaignRequest $request, $Campaign, UpdateCampaign $updateCampaign)
    {
        $Campaign = Campaign::findOrFail($Campaign);
        return $this->update($request, $Campaign, $updateCampaign);
    }


}
