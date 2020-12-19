<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table='news';
    protected $guarded=[];

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
