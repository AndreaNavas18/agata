<?php

namespace App\Models\Permissions;

use App\Models\Submodules\Submodule;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends SpatiePermission
{
    use SoftDeletes;

    public function submodule()
    {
        return $this->belongsTo(Submodule::class, 'submodule_id');
    }
}
