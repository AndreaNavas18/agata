<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commercial\DetailsQuotesSection;
use App\Models\Commercial\DetailsQuotesTariffs;
use App\Models\General\TypeDocument;


class Quotes extends Model
{
    protected $table = 'quotes';
    protected $fillable = [
        'issue',
        'consecutive',
        'name',
        'type_document_id',
        'identification',
        'email',
        'phone',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quote) {

            $lastConsecutive = static::orderBy('id', 'desc')->value('consecutive');
            
            if ($lastConsecutive) {
                $parts = explode('-', $lastConsecutive);
                if (count($parts) >= 2) {
                    $lastConsecutiveNumber = (int) end($parts);
                } else {
                    $lastConsecutiveNumber = 0;
                }
            } else {
                $lastConsecutiveNumber = 9999;
            }
    
            $nextConsecutiveNumber = $lastConsecutiveNumber + 1;
    
            // Generar el consecutivo
            $quote->consecutive = 'ST-' . $nextConsecutiveNumber;
        });
    }


    // public function tariffs() {
    //     return $this->belongsToMany(DetailsQuotesTariffs::class, 'details_quotes_tariffs', 'quote_id', 'tariff_id');
    // }

    public function tariffs()
    {
        // return $this->belongsToMany(CommercialTariff::class, 'details_quotes_tariffs', 'quote_id', 'tariff_id');
        return $this->belongsToMany(CommercialTariff::class, 'details_quotes_tariffs', 'quote_id', 'tariff_id')
        ->withPivot('id', 'address', 'observation', 'nrc_12', 'nrc_24', 'nrc_36', 'mrc_12', 'mrc_24', 'mrc_36');
    }

    public function sections() {
        return $this->hasMany(DetailsQuotesSection::class, 'quote_id');
    }

    public function typeDocument() {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }

    public function details()
    {
        return $this->hasMany(DetailsQuotesTariffs::class);
    }



}
