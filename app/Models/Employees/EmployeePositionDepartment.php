<?php

namespace App\Models\Employees;

use App\Models\BaseModel;

class EmployeePositionDepartment extends BaseModel {

	protected $table = 'employees_positions_departments';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    public function positions() {
        return $this->hasMany(EmployeePosition::class, 'department_id');
    }

}






