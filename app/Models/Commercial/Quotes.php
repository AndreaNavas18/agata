<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    protected $table = 'quotes';
    protected $fillable = [
        'name',
        'identification',
        'email',
        'phone',
        'direction',
        'observation'
    ];

}
