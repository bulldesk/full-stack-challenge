<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name', 'country_id'];

    protected $dates = ['deleted_at'];

    public function city()
    {
        return $this->hasMany('App\City');
    }

    function country() {
        return $this->belongsTo('App\Country');
    }
}
