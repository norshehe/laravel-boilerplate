<?php

namespace App\Exports;

use App\Models\AccountModel;
use App\Models\UserModel;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

class PurchaseRequestReport implements FromArray, ShouldAutoSize
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
                    'Purchase Request No.',
                    'Subject',
                    'Status',
                    'Created Time',
                    'Assigned To',
                ];

                foreach ($this->data as $data) {
                    $tech = UserModel::where('id', $data['smownerid'])->first();

                        $toExport[] = [
                            $data['purchaseorder_no'],
                            $data['subject'],
                            $data['postatus'],
                            $data['createdtime'],
                            $tech->first_name.' '.$tech->last_name,
                        ];

                }
    
    


        return $toExport;
    }

}
