<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryBL extends Model
{
    use HasFactory;

    protected $table = 'inventory_bls';

    protected $fillable = [
        'bl_number',
        'bl_quantity',
        'landed_quantity',
        'index_number',
        'bl_document',
        'provisional_price',
        'date',
        'status'
    ];

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function contracts()
    {
        return $this->hasMany(ContractBL::class,'inventorybl_id');
    }

    public function liftings()
    {
        return $this->hasMany(LiftingBL::class,'bl_id');
    }

    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function commingle_bls()
    {
        return $this->hasMany(CommingleBL::class,'bl_id','id');
    }

    function qty_status() {
    	$lifted = LiftingBL::where('bl_id',  $this->id)->sum('quantity');
    	return $this->landed_quantity - $lifted;
    }

    function shortage_status() {
    	return number_format($this->bl_quantity - $this->landed_quantity,3);
    }

    function lifted_qty() {
    	$lifted = LiftingBL::where('bl_id',  $this->id)->sum('quantity');
    	return $lifted;
    }

    function unlifted_qty() {
    	$lifted = LiftingBL::where('bl_id',  $this->id)->sum('quantity');
    	return $this->landed_quantity - $lifted;
    }

    function unsold_qty() {
    	$allocated = BLAllocation::where('bl_id',  $this->id)->sum('quantity');
    	return $this->landed_quantity - $allocated;
    }
}
