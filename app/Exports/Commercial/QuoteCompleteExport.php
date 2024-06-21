<?php

namespace App\Exports\Commercial;

use App\Models\Commercial\Quotes;
use App\Models\Commercial\DetailsQuotesTariffs;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class QuoteCompleteExport implements WithMultipleSheets
{
    protected $quote;
    protected $bandwidths;
    protected $typeservices;

    public function __construct($quote, $bandwidths, $typeservices)
    {
        $this->quote = $quote;
        $this->bandwidths = $bandwidths;
        $this->typeservices = $typeservices;
    }

    public function sheets(): array
    {
        $sheets = [];

        
        $sheets[] = new QuoteInfoExport($this->quote);

        // Agrego la cotizacion
        if ($this->quote->tariffs()->exists()) {
            $sheets[] = new QuoteExport($this->quote, $this->bandwidths);
        }

        $sheets[] = new QuoteFormalInfo($this->quote, $this->bandwidths, $this->typeservices);

        if ($this->quote->sections()->exists()) {
            $sheets[] = new SectionsExport($this->quote);
        }

        return $sheets;
    }


}
