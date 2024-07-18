<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use FontLib\Table\Type\name;
use App\Models\General\Proyecto;
use App\Models\Users\User;

class DetailsUsersProyectos extends Model
{
    protected $table = 'details_users_proyectos';

    protected $fillable = [
        'user_id',
        'proyecto_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
