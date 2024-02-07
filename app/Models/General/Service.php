<?php

namespace App\Models\General;

use App\Models\BaseModel;

class Service extends BaseModel {

	protected $table = 'general_services';
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






