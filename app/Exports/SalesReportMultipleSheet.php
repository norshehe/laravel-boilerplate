<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SalesReportMultipleSheet implements WithMultipleSheets
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;


    public function __construct($data)
    {
        $this->data = $data;
     
    }

    public function sheets(): array
    {

        $sheets = [];
 
        foreach($this->data as $key => $data)
        {
            $sheets[] = new SalesReport($data, $key);

        }

        // for ($month = 1; $month <= 12; $month++) {
        //     $sheets[] = new UsersExport($this->year, $month);
        // }

        return $sheets;
    }
}