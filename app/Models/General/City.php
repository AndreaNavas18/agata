<?php

namespace App\Models\General;

use App\Models\BaseModel;

class City extends BaseModel {

	protected $table = 'general_cities';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeName($query, $name)
    {
    	return $query->where('name', $name);
    }

    public function scopeDepartmentId($query, $departmentId)
    {
    	return $query->where('department_id', $departmentId);
    }

    /**
     * Get the user that owns the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

}






