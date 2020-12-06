<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public $timestamps=false;
    protected $guarded=[];

    public function linkTypes(){
        return $this->belongsTo('App\Models\LinkType','link_type_id');
    }

}
