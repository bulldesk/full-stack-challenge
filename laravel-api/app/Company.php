<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    public function leed()
    {
        return $this->hasMany('App\Leed');
    }
}
