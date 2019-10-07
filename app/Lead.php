<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'document',
        'company',
        'role',
        'phone',
        'city',
        'state',
        'country',
        'status',
        'funnel_stage',
        'business_title',
        'business_value',
        'conversions',
        'last_conversion',
        'domain',
        'register_date',
        'url',
    ];
}
