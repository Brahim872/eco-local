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

    protected $table = "contacts";


    public function companies(){
        return $this->belongsTo( Company::class, 'company_id' );
    }



}
