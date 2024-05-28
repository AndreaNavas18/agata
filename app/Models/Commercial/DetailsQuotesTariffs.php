<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsQuotesTariffs extends Model
{
    protected $table = 'details_quotes_tariffs';

    protected $fillable = [
        'quote_id',
        'name_service',
        'bandwidth',
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
}
