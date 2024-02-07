<?php

namespace App\Models\Employees;

use App\Models\BaseModel;

class EmployeeFile extends BaseModel {

	protected $table = 'employees_files';
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






