<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'state_id'];

    protected $dates = ['deleted_at'];

    public function leeds()
    {
        return $this->hasMany('App\Leed');
    }

    function state() {
        return $this->belongsTo('App\State');
    }
}
