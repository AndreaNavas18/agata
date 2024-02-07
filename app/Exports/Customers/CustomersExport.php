<?php

namespace App\Exports\Customers;

use App\Exports\Customers\CustomerContacsSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CustomersExport implements ShouldAutoSize, WithMultipleSheets
{
    use Exportable;

    public $customers;

    public function __construct($customers)
    {
        $this->customers = $customers;
    }

    public function sheets(): array
    {

        return [
            new CustomerInfoSheet($this->customers),
            new CustomerContacsSheet($this->customers),
            new CustomerServicesSheet($this->customers),
        ];
    }
}
