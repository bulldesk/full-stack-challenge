<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeedStates extends Model
{
    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    public function leed()
    {
        return $this->hasMany('App\Leed');
    }
}
