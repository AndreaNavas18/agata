<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialTariff extends Model
{
    // use HasFactory;

    protected $table = 'commercial_tariffs';
    protected $fillable = [
        'commercial_type_service_id',
        'bandwidth_id',
        'recurring_value_12',
        'recurring_value_24',
        'recurring_value_36',
        'value_mbps_12',
        'value_mbps_24',
        'value_mbps_36',
    ];
    protected $guarded = [];

    /* *************************************************************
	 * scopes
	* *************************************************************/
    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    public function scopeRecurring_value($query, $value)
    {
        return $query->where('recurring_value', 'like', '%' . $value . '%');
    }

    public function scopeValue_Mbps($query, $value)
    {
        return $query->where('value_Mbps', 'like', '%' . $value . '%');
    }

    public function scopeMonths($query, $months)
    {
        return $query->where('months', 'like', '%' . $months . '%');
    }

    public function scopeTypeServiceId($query, $serviceId)
    {
        return $query->where('commercial_type_service_id', $serviceId);
    }

    public function scopeBandwidthId($query, $bandwidthId)
    {
        return $query->where('bandwidth_id', $bandwidthId);
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

    
    //  public function detailsByNameService()
    //  {
    //      return $this->belongsToMany(Quotes::class, 'details_quotes_tariffs', 'tariff_id', 'quote_id');
    //  }

    public function quotes()
    {
        return $this->belongsToMany(Quote::class, 'details_quotes_tariffs', 'tariff_id', 'quote_id');
    }

    public function details()
    {
        return $this->hasOne(DetailsQuotesTariffs::class, 'tariff_id');
    }
 


    /* *************************************************************
	 * funciones
	* *************************************************************/


    //Buscar Tarifas
    public static function buscarTarifas($data)
    {
        $tariff = new CommercialTariff();


        // $tariff = $tariff->with(
        //     'comercialTypeService:id, name',
        //     'bandwidth:id,name',
        // );


        if (isset($data['commercial_type_servicesId']) && !is_null($data['commercial_type_servicesId'])) {
            $tariff = $tariff->typeServiceId($data['commercial_type_servicesId']);
        }

        if (isset($data['bandwidth_id']) && !is_null($data['bandwidth_id'])) {
            $tariff = $tariff->bandwidthId($data['bandwidth_id']);
        }

        if (isset($data['recurring_value']) && !is_null($data['recurring_value'])) {
            $tariff = $tariff->recurring_value($data['recurring_value']);
        }

        if (isset($data['months']) && !is_null($data['months'])) {
            $tariff = $tariff->months($data['months']);
        }
        if (isset($data['value_Mbps']) && !is_null($data['value_Mbps'])) {
            $tariff = $tariff->value_Mbps($data['value_Mbps']);
        }

        return $tariff;
    }
}
