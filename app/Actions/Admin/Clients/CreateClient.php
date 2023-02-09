<?php

namespace App\Actions\Admin\Clients;

use App\Models\Client;
use App\Models\Contacte;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CreateClient
{
    public function handle(Request $request): Client
    {


        $file = $request->file('image');

        if(isset($file)){
            $extension = $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('images/profile', $file, uniqid().'.'.$extension);
        }


        $Client = Client::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'password' => Hash::make($request->password),
            'profile' => $path??NULL,
            'phone' =>  $request->phone,
        ]);

        $tag = new Contacte();
        $tag->user_id = $request->company_id;
        $tag->contact_type = Client::class ;


        $Client->Contact()->save($tag);

        return $Client;
    }
}
