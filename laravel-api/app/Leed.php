<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leed extends Model
{
    protected $fillable = [
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
