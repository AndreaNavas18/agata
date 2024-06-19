<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commercial\DetailsQuotesSection;
use App\Models\Commercial\DetailsQuotesTariffs;


class Quotes extends Model
{
    protected $table = 'quotes';
    protected $fillable = [
        'issue',
        'consecutive',
        'name',
        'identification',
        'email',
        'phone',
        'observation'
    ];

    public function tariffs() {
        return $this->hasMany(DetailsQuotesTariffs::class, 'quote_id');
    }

    public function sections() {
        return $this->hasMany(DetailsQuotesSection::class, 'quote_id');
    }



}
