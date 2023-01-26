<?php

namespace App\Actions\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateClient
{
    public function handle(Request $request, User $user): User
    {

        $path = $user->profile;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('images/profile', $file, uniqid().'.'.$extension);
        }



        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile' => $path??NULL,
            'phone' =>  $request->phone,
        ]);

//        if ($request->password) {
//            $user->update([
//                'password' => Hash::make($request->password),
//            ]);
//        }

        $roles = $request->roles ?? [];
        $user->syncRoles($roles);

        return $user;
    }


    public function changePassword(Request $request, User $user): User
    {



        $validator->after(function ($validator) use ($request) {
            if ($validator->failed()) {
                return;
            }
            if (! Hash::check($request->input('old_password'), \Auth::user()->password)) {
                $validator->errors()->add(
                    'old_password', __('Old password is incorrect.')
                );
            }
        });

        $validator->validateWithBag('password');

        $user = \Auth::user()->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

   return  $user;
    }
}
