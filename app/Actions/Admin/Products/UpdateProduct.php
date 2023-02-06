<?php

namespace App\Actions\Admin\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateProduct
{
    public function handle(Request $request, Product $model): Product
    {

        $path = $model->profile;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('images/products', $file, uniqid() . '.' . $extension);
        }


        $model->update([
            'name' => $request->name,
            'description' => $request->description,
            'profile' => $path ?? NULL,
        ]);

        return $model;
    }


    public function changePassword(Request $request, User $user): User
    {


        $validator->after(function ($validator) use ($request) {
            if ($validator->failed()) {
                return;
            }
            if (!Hash::check($request->input('old_password'), \Auth::user()->password)) {
                $validator->errors()->add(
                    'old_password', __('Old password is incorrect.')
                );
            }
        });

        $validator->validateWithBag('password');

        $user = \Auth::user()->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        return $user;
    }
}
