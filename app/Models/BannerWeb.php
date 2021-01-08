<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerWeb extends Model
{
    protected $table='banners_web';
    public $timestamps=false;

    protected $guarded=[];

    public function disposition(){
        return $this->belongsTo('App\Models\BannerDisposition','disposition_id');
    }

    public function limit(){
        return $this->belongsTo('App\Models\BannerLimit','limit_id');
    }

    public function serial_number(){
        return $this->belongsTo('App\Models\BannerSerialNumber','serial_number_id');
    }
}
