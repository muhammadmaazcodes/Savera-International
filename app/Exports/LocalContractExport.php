<?php

namespace App\Exports;

use App\Models\LocalContract;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LocalContractExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $type;

    function __construct($type) {
            $this->type = $type;
    }

    public function collection()
    {
        $contracts = LocalContract::all();
        $local_contracts = array();

        foreach ($contracts as $key => $contract) {
            if ($this->type == 'vessel') {
                $local_contracts[$key] = array(
                    'vessel_name' => $contract->inventory->vessel->name ?? 'N/A',
                    'voyage_number' => $contract->inventory->voyage_number ?? 'N/A',
                    'seller_name' => $contract->business->name ?? 'N/A',
                    'product' => $contract->product->name ?? 'N/A',
                    'landed_quantity' => $contract->inventory->landed_qty ?? 'N/A',
                    'sold_quantity' => 'N/A',
                    'unsold_quantity' => 'N/A',
                    'lifted_quantity' => 'N/A'
                );
            }
            if ($this->type == 'buyer') {
                $local_contracts[$key] = array(
                    'buyer_name' => $contract->buyer->name ?? 'N/A',
                    'vessel_name' => $contract->inventory->vessel->name ?? 'N/A',
                    'product' => $contract->product->name ?? 'N/A',
                    'contract_quantity' => $contract->quantity ?? '0.00',
                    'lifted_quantity' => '0.000',
                    'balance_quantity' => '0.000',
                    'contracts' => '0'
                );
            }
            if ($this->type == 'seller') {
                $local_contracts[$key] = array(
                    'seller_name' => $contract->business->name ?? 'N/A',
                    'vessel_name' => $contract->inventory->vessel->name ?? 'N/A',
                    'product' => $contract->product->name ?? 'N/A',
                    'contract_quantity' => $contract->quantity ?? '0.00',
                    'lifted_quantity' => '0.000',
                    'balance_quantity' => '0.000',
                    'contracts' => '0'
                );
            }
            if ($this->type == 'contracts') {
                $local_contracts[$key] = array(
                    'trans_type' => $contract->type ?? 'N/A',
                    'contract_number' => $contract->code ?? 'N/A',
                    'contract_date' => $contract->date ?? 'N/A',
                    'product' => $contract->product->code ?? 'N/A',
                    'buyer_name' => $contract->buyer->name ?? 'N/A',
                    'selling_price' => $contract->selling_price ?? '0.00',
                    'contract_quantity' => $contract->quantity ?? '0.00',
                    'balance_quantity' => '0.00'
                );
            }

        }
        return collect($local_contracts);
    }

    public function headings(): array
    {
        if ($this->type == 'vessel') {
            return [
                'Vessel',
                'Voyage Number',
                'Seller',
                'Product',
                'Landed Quantity',
                'Sold Quantity',
                'Unsold Quantity',
                'Lifted Quantity'
            ];
        }
        if ($this->type == 'buyer') {
            return [
                'Buyer',
                'Vessel',
                'Product',
                'Contract Qty',
                'Lifted Quantity',
                'Balance Quantity',
                'Contracts'
            ];
        }
        if ($this->type == 'seller') {
            return [
                'Seller',
                'Vessel',
                'Product',
                'Contract Qty',
                'Lifted Quantity',
                'Balance Quantity',
                'Contracts'
            ];
        }
        if ($this->type == 'contracts') {
            return [
                'Transaction type',
                'Contract#',
                'Contract Date',
                'Product',
                'Buyer',
                'Selling Price',
                'Contract Qty.',
                'Balance Qty.'
            ];
        }
    }
}
