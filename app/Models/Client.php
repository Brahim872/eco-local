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
        'user_id',
        'company_name',
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

    public function users(){
        return $this->belongsTo( User::class, 'user_id', 'id' );
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

}
