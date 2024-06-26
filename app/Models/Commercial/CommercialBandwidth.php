<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commercial\CommercialTariff;
use App\Models\General\Department;
use App\Models\General\City;

class CommercialBandwidth extends Model
{
   // use HasFactory;

   protected $table = 'commercial_bandwidths';
   protected $fillable = [
         'name',
         'department_id',
         'city_id',
   ];
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

    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }
    
    
}
