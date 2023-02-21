<?php

namespace App\Actions\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CreateUser
{
    public function handle(Request $request): User
    {

        $file = $request->file('image');

        if(isset($file)){
            $extension = $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('images/profile', $file, uniqid().'.'.$extension);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'profile' => $path??NULL,
            'phone' =>  $request->phone,
        ]);


        $roles = $request->roles ?? 2;
        $user->assignRole($roles);

        return $user;
    }
}
