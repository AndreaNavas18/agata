<?php

namespace App\Models\Submodules;

use App\Models\BaseModel;
use App\Models\Permisos\Permission;

class Submodule extends BaseModel
{
    protected $table = 'submodules';
    protected $fillable = ['name', 'initials'];

    // Scopes
    public function scopeName($query, $nombre)
    {
    	return $query->where('name', 'like', '%'.$nombre.'%');
    }

    // Relaciones
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

}
