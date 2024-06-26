<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commercial\Quotes;
use App\Models\Commercial\CommercialTariff;
use App\Models\Commercial\CommercialBandwidth;
use App\Models\Commercial\CommercialTypeService;

class DetailsQuotesTariffs extends Model
{
    protected $table = 'details_quotes_tariffs';

    protected $fillable = [
        'quote_id',
        'name_service',
        'bandwidth',
        'address',
        'observation',
        'nrc_12',
        'nrc_24',
        'nrc_36',
        'mrc_12',
        'mrc_24',
        'mrc_36'
    ];

    public function quote()
    {
        return $this->belongsTo(Quotes::class, 'quote_id');
    }

    public function tariff()
    {
        return $this->belongsTo(CommercialTariff::class, 'name_service', 'id');
    }

    public function bandwidth()
    {
        return $this->belongsTo(CommercialBandwidth::class, 'bandwidth', 'id');
    }
}
