<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacte extends Model
{
    use HasFactory;
//    use Sluggable;



    protected $fillable = [];
    protected $table = "bs_contactes";


    public function Company()
    {
        return $this->morphedByMany(Company::class, 'contact');
    }


    public function Client()
    {
        return $this->morphTo();
    }


}
