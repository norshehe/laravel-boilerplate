<?php

namespace App\Exports;

use App\Models\AccountModel;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

class PortalTicketReport implements FromArray, ShouldAutoSize
{
    protected $data;
    protected $columns;



    public function __construct($data, $columns)
    {
        $this->data = $data;
        $this->columns = $columns;
   
    }

    // public function headings(): array
    // {
    //     return [
    //         'Services/Products',
    //         'Quantity',
    //         'Price',
    //         'Monthly Rate',
    //         'One Time Set-up Fee',
    //         'Net Price',
    //     ];
    // }

    public function array(): array
    {

        $toExport = array();
        $columns = [];
        foreach($this->columns as $column)
            if(isset($column['columnname']))
                $columns[] = $column['label'];
        $toExport[] = $columns;
        foreach ($this->data as $data) {
            $row = [];
            foreach($this->columns as $column)
            {
                if(isset($column['columnname']))
                {
                    $columnname = $column['columnname'];
                    $row[] = $data[$columnname];
                }
            }
            $toExport[] = $row;
        }
        return $toExport;
    }

}
