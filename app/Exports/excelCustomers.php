<?php

namespace App\Exports;

use App\Customers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class excelCustomers implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'E-mail',
            'Enabled'
        ];
    }

    public function collection()
    {
        return Customers::all();
    }
}
