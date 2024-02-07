<?php

namespace App\Models\Roles;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    public function scopeNoCustomerRole($query)
    {
        return $query->where('id','<>',2 );
    }

}
