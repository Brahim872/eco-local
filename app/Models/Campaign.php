<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'subject',
        'content',
        'status',
        'archived_at',
        'scheduled_at'
    ];
    protected $table = "campaigns";


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title'],
                'separator' => '_'
            ]
        ];
    }
}
