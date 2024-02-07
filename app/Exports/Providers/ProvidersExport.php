<?php

namespace App\Exports\Providers;

use App\Exports\Customers\CustomerContacsSheet;
use App\Models\Providers\Provider;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProvidersExport implements ShouldAutoSize, WithMultipleSheets
{
    use Exportable;

    public $providers;

    public function __construct($providers)
    {
        $this->providers = $providers;
    }

    public function sheets(): array
    {

        return [
            new ProviderInfoSheet($this->providers),
            new ProviderContacsSheet($this->providers),
            new ProviderServicesSheet($this->providers),
        ];
    }
}
