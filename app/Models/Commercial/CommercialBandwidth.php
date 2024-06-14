<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commercial\CommercialTariff;

class CommercialBandwidth extends Model
{
   // use HasFactory;

   protected $table = 'commercial_bandwidths';
   protected $fillable = [];
   protected $guarded = [];

    /* *************************************************************
	 * scopes
	* *************************************************************/
    public function scopeName($query, $name)
    {
    	return $query->where('name', 'like', '%'.$name.'%');
    }

    public function tariffs() {
        return $this->hasMany(CommercialTariff::class, 'bandwidth_id');
    }
    
}
