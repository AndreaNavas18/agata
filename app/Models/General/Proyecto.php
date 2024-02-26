<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\CustomerService;

class Proyecto extends Model
{
    protected $table = 'proyectos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name',
        'description',
        // Otros campos
    ];

    // Relaciones con otros modelos si es necesario
    //Relacion con la tabla customers_services por el campo proyecto_id 
    public function servicios()
    {
        return $this->hasMany(CustomerService::class, 'proyecto_id');
    }
    
}
