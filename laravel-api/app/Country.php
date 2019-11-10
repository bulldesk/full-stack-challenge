<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $fillable = ['country_name'];

    protected $dates = ['deleted_at'];

    function state() {
        return $this->hasMany('App\State');
    }
   
}
