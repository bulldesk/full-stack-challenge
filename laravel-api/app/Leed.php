<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leed extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name', 
        'email', 
        'cpf', 
        'job', 
        'phone', 
        'title', 
        'value', 
        'conversions', 
        'last_conversions', 
        'domain', 
        'registration_date', 
        'url',
        'company_id',
        'city_id',
        'leed_status_id',
        'leed_states_id'
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'registration_date' => 'datetime',
        'value' => 'float'
    ];

    function company() {
        return $this->belongsTo('App\Company');
    }
    function city() {
        return $this->belongsTo('App\City');
    }
    function leedStatus() {
        return $this->belongsTo('App\LeedStatus');
    }
    function leedStates() {
        return $this->belongsTo('App\LeedStates');
    }
}
