<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Sluggable;


    protected $fillable = [
      'id',
      'name',
      'description',
    ];

    protected $table = "bs_products";

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '-'
            ]
        ];

    }

    /**
     * The roles that belong to the user.
     */

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'bs_products_clients');
    }
}
