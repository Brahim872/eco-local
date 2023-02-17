<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    use Sluggable;



    protected $fillable = [
        'name',
        'address',
        'website',
        'profile',
        'user_id',
        'slug',
    ];

    protected $table = "bs_companies";

    public function users(){
        return $this->belongsTo( User::class, 'user_id', 'id' );
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['id', 'name'],
                'separator' => '_'
            ]
        ];
    }


    /**
     * Get all of the tags for the post.
     */
    public function contact()
    {
        return $this->morphMany(Contacte::class, 'contact');
    }

    public function client(){
        return $this->hasMany( Client::class, 'company_id', 'id' );
    }




}
