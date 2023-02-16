<?php

namespace App\Actions\Admin\Campaigns;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateCampaign
{
    public function handle(Request $request, Company $model): Company
    {

        $path = $model->profile;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('images/profile', $file, uniqid().'.'.$extension);
        }


        $model->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile' => $path??NULL,
            'phone' =>  $request->phone,
        ]);

        return $model;
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
