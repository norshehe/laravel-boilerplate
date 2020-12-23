<?php

namespace App\Exports;

use App\Models\AccountModel;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

class PendingTicketsReport implements FromArray, ShouldAutoSize
{
    protected $data;



    public function __construct($data)
    {
        $this->data = $data;
   
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
                // $toExport[] = [
                //     $this->reports[$account][0][0]['salesorder']['account']['accountname']
                // ];
                $toExport[] = [
                    'Ticket No.',
                    'Priority',
                    'Subject',
                    'Status',
                    'Assigned To',
                    'Remaining Time',
                ];

                foreach ($this->data as $data) {

                        $toExport[] = [
                            $data['ticket_no'],
                            $data['priority'],
                            $data['title'],
                            $data['status'],
                            $data['technician'],
                            $data['helpdesk_sla_remain'],
                        ];

                }
    
    


        return $toExport;
    }

}
