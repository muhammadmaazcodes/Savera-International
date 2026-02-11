<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    use HasFactory;
    protected $table = 'inventory_stock';
    protected $fillable = ['product_id','terminal_id','terminal_quantity','terminal_shortage','remarks'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }

    public function sold_qty()
    {
        $contractIDs = LocalContract::where('product_id',$this->product_id)->pluck('id')->toArray();
        $sold_qty = VesselAllocation::where('inventory_id',$this->inventory_id)->whereIn('contract_id',$contractIDs)->sum('quantity');
        return $sold_qty;
    }

    public function lifted_qty()
    {
        $lifted_qty = SalesRequest::where('inventory_id',$this->inventory_id)->where('product_id',$this->product_id)->sum('quantity');
        return $lifted_qty;
    }

    public function unsold_qty()
    {
        return $this->terminal_quantity - $this->sold_qty();
    }
}
