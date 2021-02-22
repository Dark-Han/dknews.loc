<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

    protected $guarded=[];
    public $timestamps = false;

    public function sluggable()
    {
        return [
            'slug_ru' => [
                'source' => 'name_ru'
            ],
            'slug_kz' => [
                'source' => 'name_kz'
            ],
            'slug_en' => [
                'source' => 'name_en'
            ],
            'slug_cn' => [
                'source' => 'name_cn'
            ]
        ];
    }
}
