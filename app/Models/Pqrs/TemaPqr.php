<?php

namespace App\Models\Pqrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employees\EmployeePositionDepartment as Department;

class TemaPqr extends Model
{
    use HasFactory;

    protected $table = 'temas_pqrs'; 

    protected $fillable = [
        'name',
        'department_id',
    ];

    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
