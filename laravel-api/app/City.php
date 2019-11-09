<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'state_id'];

    protected $dates = ['deleted_at'];

    function state() {        
        return $this->belongsTo('App\State');
    }
    function leed() {        
        return $this->belongsTo('App\Leed');
    }
}
