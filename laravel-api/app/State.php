<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'country_id'];

    protected $dates = ['deleted_at'];

    function city() {
        return $this->hasMany('App\City');
    }
    function country() {
        return $this->belongsTo('App\Country');
    }
}
