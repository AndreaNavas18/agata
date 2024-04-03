<?php

namespace App\Models\Employees;

use App\Models\BaseModel;

class EmployeePensionFund extends BaseModel {

	protected $table = 'employees_pension_fund';
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






