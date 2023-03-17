<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    protected $guarded = [];
    public $timestamps = false;
    public function companies()
    {
        return $this->belongsTo(Company::class, 'city_id', 'id');
    }

}
