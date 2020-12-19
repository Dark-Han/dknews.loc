<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $guarded=[];
    public $timestamps=false;

    public function journalTypes(){
        return $this->belongsTo('App\Models\JournalType','journal_type_id');
    }
}
