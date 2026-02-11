<?php

namespace App\Exports;

use App\Models\SalesRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class SaleRequestExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $status;

    function __construct($status) {
        $this->status = $status;
    }

    public function collection()
    {
        $data = SalesRequest::where('status',$this->status)->get();
        $sales = [];
        foreach ($data as $key => $sale) {
            $sales[$key] = array(
                'buyer' => $sale->buyer->name ?? '--',
                'product' => $sale->product->code ?? '--',
                'vessel' => $sale->inventory->vessel->name ?? '--',
                'terminal' => $sale->terminal->code ?? '--',
                'vehicle' => $sale->vehicle_number ?? '--',
                'requested_qty' => $sale->quantity
            );
        }
        return collect($sales);
    }

    public function headings(): array
    {
        return [
            "Buyer",
            "Product",
            "Vessel",
            "Terminal",
            "Vehicle",
            "Requested Quantity"
        ];
    }
}
