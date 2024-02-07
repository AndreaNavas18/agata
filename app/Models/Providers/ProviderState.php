<?php

namespace App\Models\Providers;

use App\Models\BaseModel;

class ProviderState extends BaseModel {

	protected $table = 'providers_states';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeIdentification($query, $identification)
    {
    	return $query->where('identification', 'like', '%'.$identification.'%');
    }
}






