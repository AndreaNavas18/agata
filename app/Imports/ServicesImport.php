<?php

namespace App\Imports;

use App\Imports\CustomerServiceImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\Log;

class ServiceImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Hoja1' => new CustomerServiceImport(),
        ];
    }
}