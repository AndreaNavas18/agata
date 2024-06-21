<?php

namespace App\Exports\Commercial;

use App\Models\Commercial\Quotes;
use App\Models\Commercial\DetailsQuotesTariffs;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class QuoteFormalComplete implements WithMultipleSheets
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

         // Agrega la hoja de QuoteFormalExport si existen datos
         if ($this->quote->tariffs()->exists()) {
            $sheets[] = new QuoteFormalExport($this->quote, $this->bandwidths, $this->typeservices);
        }

        $sheets[] = new QuoteFormalInfo($this->quote, $this->bandwidths, $this->typeservices);

        return $sheets;
    }


}
