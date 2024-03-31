<?php

namespace App\Models\Roles;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    public function scopeNoCustomerRole($query)
    {
        //Se hace el cambio para poder cambiar roles en la vista 
        return $query
        ->where( 'id' , '>' , 4 )
        //Que no puedan crear usuarios administradores
        ->where('id', '!=', 6)
        //Que no puedan crear usuarios director soporte
        ->where('id', '!=', 10)
        //Que no puedan crear usuarios programadores
        ->where('id', '!=', 9);
        
    }

}
