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

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
