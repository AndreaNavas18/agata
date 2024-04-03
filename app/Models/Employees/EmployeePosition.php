<?php

namespace App\Models\Employees;

use App\Models\BaseModel;

class EmployeePosition extends BaseModel {

	protected $table = 'employees_positions';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    //relaciones
    /**
     * Get the user that owns the EmployeePosition
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(EmployeePositionDepartment::class, 'department_id');
    }

}






