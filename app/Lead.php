<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
	protected $fillable = [ 
		"name", 
		"email", 
		"cpfcnpj", 
		"company", 
		"occupation", 
		"phone", 
		"city",
		"state",
		"country",
		"status",
		"stage",
		"business_title",
		"business_value",
		"conversions",
		"last_conversion",
		"domain",
		"register_date",
		"url",
		"import_id"
	];

    /**
     * Get the Import that owns the Lead.
     */
    public function import()
    {
        return $this->belongsTo('App\Import');
    } 
}
