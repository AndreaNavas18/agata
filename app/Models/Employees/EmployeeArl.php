<?php

namespace App\Models\Employees;

use App\Models\BaseModel;

class EmployeeArl extends BaseModel {

	protected $table = 'employees_arl';
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






