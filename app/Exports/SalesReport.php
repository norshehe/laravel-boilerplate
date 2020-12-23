<?php

namespace App\Exports;

use App\Models\AccountModel;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

class SalesReport implements FromArray, WithTitle, ShouldAutoSize
{
    protected $data;
    protected $key;
 


    public function __construct($data, $key)
    {
        $this->data = $data;
        $this->key = $key;
   
    }

    public function array(): array
    {
        $mainArray = array();

        foreach ($this->data as $data) {

            if($data)
            {
                $toExport = array();
                // $toExport[] = [
                //     $this->reports[$account][0][0]['salesorder']['account']['accountname']
                // ];
                $toExport[] = [
                    $data[0]['salesorder']['account']['accountname'],
                    'Service/Product',
                    'Quantity',
                    'Price',
                    'One Time Set-up Fee',
                    'One Time Set-up Fee Total',
                    'MRC Discount',
                    'OTSF Discount',
                    'MRC Net',
                    'Net Price',
                    'Remarks',
                ];
                $total = [
                    "cf_salesorder_iotsft" => 0,
                    "cf_salesorder_mrc_discount" => 0,
                    "cf_salesorder_otsf_discount" => 0,
                    "cf_salesorder_mrc_net" => 0,
                    "net_price" => 0
                ];
                foreach ($data as $item) {

           

                        if ($item['initial']) {
                            $cf_salesorder_one_time_setup_fee =  $item['cf_salesorder_one_time_setup_fee'];
                            $cf_salesorder_iotsft =  $item['cf_salesorder_iotsft'];
                            $cf_salesorder_otsf_discount = $item['cf_salesorder_otsf_discount'];
                            $net_price =  (int)$item['net_price'] - ((int)$item['cf_salesorder_mrc_discount'] + (int)$item['cf_salesorder_otsf_discount']);
               
                            $total["cf_salesorder_iotsft"] = (int)$total["cf_salesorder_iotsft"] + (int)$cf_salesorder_iotsft;
                            $total["cf_salesorder_otsf_discount"] = (int)$total["cf_salesorder_otsf_discount"] + (int)$cf_salesorder_otsf_discount;
                            $total["net_price"] = (int)$total["net_price"] + (int)$net_price;
                        } else {
                            $cf_salesorder_one_time_setup_fee =  '0';
                            $cf_salesorder_iotsft =  '0';
                            $cf_salesorder_otsf_discount = '0';
                            $net_price =  $item['cf_salesorder_mrc_net'];
                            
                            $total["net_price"] = (int)$total["net_price"] + (int)$item['cf_salesorder_mrc_net'];
                        }
                        $total["cf_salesorder_mrc_discount"] = (int)$total["cf_salesorder_mrc_discount"] + (int)$item['cf_salesorder_mrc_discount'];
                        $total["cf_salesorder_mrc_net"] = (int)$total["cf_salesorder_mrc_net"] + (int)$item['cf_salesorder_mrc_net'];
                        $toExport[] = [
                            'record' => $item['salesorder']['subject'],
                            'servicename' => $item['service']['servicename'],
                            'quantity' => $item['quantity'],
                            'listprice' => $item['cf_salesorder_price'],
                            'cf_salesorder_one_time_setup_fee' => $cf_salesorder_one_time_setup_fee,
                            'cf_salesorder_iotsft' =>$cf_salesorder_iotsft,
                            'cf_salesorder_mrc_discount' => $item['cf_salesorder_mrc_discount'],
                            'cf_salesorder_otsf_discount' => $cf_salesorder_otsf_discount,
                            'cf_salesorder_mrc_net' => $item['cf_salesorder_mrc_net'],
                            'net_price' => strval($net_price),
                            'remarks' => $item['cf_salesorder_discount_description'],
                        ];
                    
                }
                $toExport[] = [
                    'Total:',
                    '',
                    '',
                    '',
                    '',
                    strval($total['cf_salesorder_iotsft']),
                    strval($total['cf_salesorder_mrc_discount']),
                    strval($total['cf_salesorder_otsf_discount']),
                    strval($total['cf_salesorder_mrc_net']),
                    strval($total['net_price']),
                ];
                $toExport[] = [
                    ''
                ];
                $mainArray[] = $toExport;
            }
                
            
        }

        return $mainArray;
    }


    public function title(): string
    {
        return 'Month ' . $this->key;
    }
}