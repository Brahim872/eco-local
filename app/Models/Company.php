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
        'email',
        'password',
        'phone',
        'website',
        'profile',
        'user_id',
        'slug',
    ];

    protected $table = "bs_companies";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



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
    public function Contact()
    {
        return $this->morphMany(Contacte::class, 'contact');
    }

    public function client(){
        return $this->hasMany( Client::class, 'company_id', 'id' );
    }




}
