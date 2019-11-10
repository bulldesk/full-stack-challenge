<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeedStatus extends Model
{
    use SoftDeletes;

    protected $fillable = ['status_leed_name'];

    protected $dates = ['deleted_at'];

    function leed() {        
        return $this->hasMany('App\Leed');
    }
    
}
