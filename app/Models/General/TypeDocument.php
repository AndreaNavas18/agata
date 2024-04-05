<?php

namespace App\Models\General;

use App\Models\BaseModel;

class TypeDocument extends BaseModel {

	protected $table = 'general_types_documents';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }

}






