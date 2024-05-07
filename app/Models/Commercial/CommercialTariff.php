<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialTariff extends Model
{
   // use HasFactory;

   protected $table = 'commercial_tariffs';
   protected $fillable = [];
   protected $guarded = [];

    /* *************************************************************
	 * scopes
	* *************************************************************/
    public function scopeName($query, $name)
    {
    	return $query->where('name', 'like', '%'.$name.'%');
    }

    public function scopeRecurring_value($query, $value)
    {
    	return $query->where('recurring_value', 'like', '%'.$value.'%');
    }

    public function scopeValue_Mbps($query, $value)
    {
    	return $query->where('value_Mbps', 'like', '%'.$value.'%');
    }

    public function scopeMonths($query, $months)
    {
    	return $query->where('months', 'like', '%'.$months.'%');
    }

    /* *************************************************************
	 * relaciones
	* *************************************************************/

    public function comercialTypeService()
    {
        return $this->belongsTo(CommercialTypeService::class, 'commercial_type_service_id');
    }

    public function bandwidth()
    {
        return $this->belongsTo(CommercialBandwidth::class, 'bandwidth_id');
    }

}
