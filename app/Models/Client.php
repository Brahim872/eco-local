<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    use Sluggable;



    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'address',
        'email',
        'password',
        'phone',
        'profile',
    ];

    protected $table = "bs_clients";

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

    public function company(){
        return $this->belongsTo( Company::class, 'company_id', 'id' );
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['first_name', 'last_name'],
                'separator' => '_'
            ]
        ];
    }

    /**
     * The users that belong to the role.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'bs_products_clients');
    }

    /**
     * Get all of the tags for the post.
     */
    public function Contact()
    {
        return $this->morphMany(Contact::class, 'contact');
    }
}
