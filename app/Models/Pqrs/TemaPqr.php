<?php

namespace App\Models\Pqrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemaPqr extends Model
{
    use HasFactory;

    protected $table = 'pqrs'; 

    protected $fillable = [
        'name',
        'department_id',
    ];
}
