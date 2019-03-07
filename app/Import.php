<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
	protected $fillable = [ "fields", "created_by" ];   

    /**
     * Get the User that owns the Import.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    } 
}
