<?php

namespace App\Actions\Admin\Clients;

use App\Models\Client;
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
            $path = Storage::disk('public')->putFileAs('uploads', $file, uniqid().'.'.$extension);
        }

        $Client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => Auth::id(),
            'password' => Hash::make($request->password),
            'profile' => $path??NULL,
            'phone' =>  $request->phone,
        ]);


        return $Client;
    }
}
