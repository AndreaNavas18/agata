<?php

namespace App\Models\Employees;

use App\Models\BaseModel;

class EmployeeState extends BaseModel {

	protected $table = 'employees_states';
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






