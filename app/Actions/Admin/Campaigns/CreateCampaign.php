<?php

namespace App\Actions\Admin\Campaigns;

use App\Models\Campaign;
use App\Models\Client;
use App\Models\Company;
use App\Models\Contacte;
use App\Models\User;
use Illuminate\Http\Request;

class CreateCampaign
{
    public function handle(Request $request): Campaign
    {

        return Campaign::create([
            'title' => $request->title,
            'subject' => $request->subject,
            'content' => $request->message,
        ]);
    }
}
