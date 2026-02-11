<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;
use Spatie\Activitylog\Exceptions\CouldNotLogActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Inventory extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'voyage_number',
        'index_number',
        'product_id',
        'company_id',
        'vessel_id',
        'terminal_id',
        'clearing_agent_id',
        'surveyor_id',
        'igm_date',
        'arrival_date',
        'active_contract',
        'type'
    ];


    public function ledgers()
    {
        return $this->morphMany(Ledger::class, 'ledgerable');
    }

    public function seller()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function buyer()
    {
        return $this->belongsTo(Business::class, 'buyer_id', 'id');
    }

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function surveyor()
    {
        return $this->belongsTo(Surveyor::class,'surveyor_id','id');
    }

    public function clearing_agent()
    {
        return $this->belongsTo(ClearingAgent::class,'clearing_agent_id','id');
    }

    public function bls()
    {
        return $this->hasMany(InventoryBL::class, 'inventory_id', 'id')->orderBy('serial_number', 'ASC');
    }

    public function stocks()
    {
        return $this->hasMany(InventoryStock::class, 'inventory_id', 'id');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function unsold_qty()
    {   
        $bl_quantity = InventoryBL::where('inventory_id', $this->id)->sum('landed_quantity');
        $sold_qty = VesselAllocation::where('inventory_id', $this->id)->sum('quantity');
        return $bl_quantity - $sold_qty;
    }

    public function unsold_qty_by_pd($product)
    {
        $bl_quantity = InventoryBL::where('inventory_id', $this->id)->where('product_id',$product)->sum('landed_quantity');
        $contracts = LocalContract::where('product_id',$product)->pluck('id')->toArray();
        $sold_qty = VesselAllocation::whereIn('contract_id',$contracts)->where('inventory_id', $this->id)->sum('quantity');
        return $bl_quantity - $sold_qty;
    }

    public function sold_qty()
    {   
        $sold_qty = VesselAllocation::where('inventory_id', $this->id)->sum('quantity');
        return $sold_qty;
    }
    
    public function landed_qty()
    {
        return $this->vessel_qty - $this->vessel_shortage;
    }

    public function shortage()
    {
        $bl_quantity = InventoryBL::where('inventory_id', $this->id)->sum('bl_quantity');
        $landed_quantity = InventoryBL::where('inventory_id', $this->id)->sum('landed_quantity');
        return $bl_quantity - $landed_quantity;
    }

    public function lifted_qty()
    {
        $bls = InventoryBL::where('inventory_id', $this->id)->pluck('id')->toArray();
        $lifted = LiftingBL::whereIn('bl_id', $bls)->sum('quantity');
    	return $lifted;
    }

    public function unlifted_qty()
    {
        return number_format($this->vessel_qty - $this->lifted_qty(),3);
    }

    public function useLog(string $logName)
    {
        $this->getActivity()->log_name = $logName;
        return $this;
    }

    public function inLog(string $logName)
    {
        return $this->useLog($logName);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['type']);
    }
}
