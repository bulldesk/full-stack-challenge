<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    public function state()
    {
        return $this->hasMany('App\State');
    }
}
