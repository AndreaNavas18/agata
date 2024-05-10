<?php

namespace App\Models\Employees;

use App\Models\BaseModel;

class EmployeeEps extends BaseModel {

	protected $table = 'employees_eps';
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






