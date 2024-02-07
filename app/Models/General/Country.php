<?php

namespace App\Models\General;

use App\Models\BaseModel;

class Country extends BaseModel {

	protected $table = 'general_countries';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeName($query, $name)
    {
    	return $query->where('name', $name);
    }

}






