<?php

namespace App\Actions\Admin\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CreateProduct
{
    public function handle(Request $request): Product
    {


        $file = $request->file('image');

        if(isset($file)){
            $extension = $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('images/products', $file, uniqid().'.'.$extension);
        }

        $Product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path??NULL,
        ]);



        return $Product;
    }
}
