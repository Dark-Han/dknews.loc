<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Sluggable;

    protected $table='news';
    protected $guarded=[];

    public function sluggable()
    {
        return [
            'slug_ru' => [
                'source' => 'title_ru'
            ],
            'slug_kz' => [
                'source' => 'title_kz'
            ],
            'slug_en' => [
                'source' => 'title_en'
            ],
        ];
    }

    public function disposition()
    {
        return $this->belongsTo('App\Models\Disposition');
    }

    public function limit()
    {
        return $this->belongsTo('App\Models\Limit');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function images(){
        return $this->hasMany('App\Models\NewsImage');
    }
}
