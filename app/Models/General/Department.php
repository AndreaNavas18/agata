<?php

namespace App\Models\General;

use App\Models\BaseModel;

class Department extends BaseModel {

	protected $table = 'general_departments';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    public function scopeCountryId($query, $countryId)
    {
    	return $query->where('country_id', $countryId);
    }

    
    public function Country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

}






