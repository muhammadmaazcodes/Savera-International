<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesselAllocation extends Model
{
    use HasFactory;

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id','id');
    }

    public function bls_allocation()
    {
        return $this->hasMany(BLAllocation::class,'vessel_allocation_id','id');
    }

    public function contract()
    {
        return $this->belongsTo(LocalContract::class,'contract_id','id');
    }

    public function lifted_qty()
    {
        // return SalesRequest::where('inventory_id',$this->inventory_id)->sum('quantity');
        return number_format(SaleContract::where('vessel_allocation_id',$this->id)->sum('quantity'),3);
    }

    public function unlifted_qty()
    {
        $lifted_qty = SaleContract::where('vessel_allocation_id',$this->id)->sum('quantity');
        return number_format($this->quantity - $lifted_qty,3);
    }
}
