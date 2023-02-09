<?php

namespace App\Actions\Admin\Companies;

use App\Models\Client;
use App\Models\Company;
use App\Models\Contacte;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CreateCompany
{
    public function handle(Request $request): Company
    {


        $file = $request->file('image');

        if(isset($file)){
            $extension = $file->getCompanyOriginalExtension();
            $path = Storage::disk('public')->putFileAs('images/profile', $file, uniqid().'.'.$extension);
        }

        $Company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => Auth::id(),
            'password' => Hash::make($request->password),
            'profile' => $path??NULL,
            'phone' =>  $request->phone,
        ]);




        $tag = new Contacte();
        $tag->user_id = Auth::id();
        $tag->contact_type = Client::class ;



        $Company->Contact()->save($tag);

        return $Company;
    }
}
