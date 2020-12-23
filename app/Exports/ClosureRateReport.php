<?php

namespace App\Exports;

use App\Models\AccountModel;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

class ClosureRateReport implements FromArray, ShouldAutoSize
{
    protected $data;



    public function __construct($data)
    {
        $this->data = $data;
   
    }


    public function array(): array
    {

                $toExport = array();
                // $toExport[] = [
                //     $this->reports[$account][0][0]['salesorder']['account']['accountname']
                // ];
                $toExport[] = [
                    'Group Name',
                    'Closed Ticket',
                    'Violated Ticket',
                    'Closure Rate',
                ];
                $closeTotal = 0;
                $violatedTotal = 0;
                foreach ($this->data as $data) {

                    if($data['ViolatedTicket'] !== 0)
                    {
                        $closureRate = 100 - ($data['ViolatedTicket']/$data['ClosedTicket']) * 100;
                    }
                    else{
                        if($data['ClosedTicket'] == 0)
                        {
                            $closureRate = 0;
                        }
                        else
                        {
                            $closureRate = 100;
                        }
                     
                    }
                    $toExport[] = [
                        $data['GroupName'],
                        strval($data['ClosedTicket']),
                        strval($data['ViolatedTicket']),
                        round($closureRate, 2).' %',
                    ];

                    $closeTotal += $data['ClosedTicket'];
                    $violatedTotal += $data['ViolatedTicket'];
                    if($data['GroupID'] == 1611)
                    {
                        foreach($data['childrenArray'] as $oss)
                        {
                            if($oss['ViolatedTicket'] !== 0)
                            {
                                $closureRate = 100 - ($oss['ViolatedTicket']/$oss['ClosedTicket']) * 100;
                            }
                            else{
                                if($oss['ClosedTicket'] == 0)
                                {
                                    $closureRate = 0;
                                }
                                else
                                {
                                    $closureRate = 100;
                                }
                             
                            }
                            $toExport[] = [
                                ' * '.$oss['GroupName'],
                                strval($oss['ClosedTicket']),
                                strval($oss['ViolatedTicket']),
                                round($closureRate, 2).' %',
                            ];
                        }
                    }

          

                }

                if($violatedTotal !== 0)
                {
                    $closureRate = 100 - ($violatedTotal/$closeTotal) * 100;
                }
                else{
                    if($closeTotal == 0)
                    {
                        $closureRate = 0;
                    }
                    else
                    {
                        $closureRate = 100;
                    }
                 
                }

                $toExport[] = [
                    'Total',
                    $closeTotal,
                    $violatedTotal,
                    round($closureRate, 2).' %',
                ];
    


        return $toExport;
    }

}
