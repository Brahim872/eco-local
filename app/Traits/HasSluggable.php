<?php

namespace App\Traits;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;

trait HasSluggable
{

    use Sluggable;

    protected static function bootHasSluggable()
    {
        static::creating(function ($model) {
            $model->slug = SlugService::createSlug(self::class, 'slug', $model->slug);
        });
    }

    public function sluggable()
    {
        return [];
    }
}
