<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsQuotesSection extends Model
{
    protected $table = 'details_quotes_section';

    protected $fillable = [
        'quote_id',
        'service_id',
        'tramo',
        'trayecto',
        'hilos',
        'extremo_a',
        'extremo_b',
        'kms',
        'recurrente_mes',
        'recurrente_12',
        'recurrente_24',
        'recurrente_36',
        'tiempo',
        'valor_km_usd',
        'valor_total_iru_usd',
        'valor_km_cop',
        'valor_total',
        'observation',
    ];

    public function quote()
    {
        return $this->belongsTo(Quotes::class, 'quote_id');
    }

    // public function tariff()
    // {
    //     return $this->belongsTo(CommercialTariff::class, 'service_id', 'id');
    // }

    public function typeService() {
        return $this->belongsTo(CommercialTypeService::class, 'service_id', 'id');
    }
}
