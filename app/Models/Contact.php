<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
//    use Sluggable;



    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'email',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
//    public function rules()
//    {
//        return [
//            'company_id' => 'required',
//            'first_name' => 'required',
//            'last_name' => 'required',
//            'email' => 'required',
//        ];
//    }

    protected $table = "contacts";


    public function companies(){
        return $this->belongsTo( Company::class, 'company_id' );
    }



}
