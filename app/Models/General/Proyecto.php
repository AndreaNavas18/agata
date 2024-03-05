<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\Customer;
use App\Models\Customers\CustomerService;

class Proyecto extends Model
{
    protected $table = 'proyectos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name',
        'description',
        'customer_id',
        // Otros campos
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function customerServices()
    {
        return $this->hasMany(CustomerService::class, 'proyecto_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'proyecto_id');
    }
    
}
