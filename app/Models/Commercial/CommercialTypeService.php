<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialTypeService extends Model
{
   // use HasFactory;

   protected $table = 'commercial_type_services';
   protected $fillable = [];
   protected $guarded = [];

    /* *************************************************************
	 * scopes
	* *************************************************************/
    public function scopeName($query, $name)
    {
    	return $query->where('name', 'like', '%'.$name.'%');
    }

    
    public function bandwidth()
    {
        return $this->belongsTo(CommercialBandwidth::class, 'bandwidth');
    }


}
