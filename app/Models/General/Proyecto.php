<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\Customer;
use App\Models\Customers\CustomerService;
use FontLib\Table\Type\name;
use App\Models\Users\User;

class Proyecto extends Model
{
    protected $table = 'proyectos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name',
        'description',
        'customer_id',
        // Otros campos
    ];

    //Scope

    public function scopeName($query, $name)
    {
        return $query->where('id', $name );
    }


    //Relaciones

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
        return $this->belongsToMany(User::class, 'details_users_proyectos', 'proyecto_id', 'user_id');
    }
}
