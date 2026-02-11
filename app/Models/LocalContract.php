<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;
use Spatie\Activitylog\Exceptions\CouldNotLogActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Carbon\Carbon;

class LocalContract extends Model
{
    use HasFactory;

    protected $table = 'contract_local';

    public function ledgers()
    {
        return $this->morphMany(Ledger::class, 'ledgerable');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function buyer()
    {
        return $this->belongsTo(Company::class,'buyer_id','id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class,'bussiness_id','id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id','id');
    }

    public function payment_terms()
    {
        return $this->belongsTo(PaymentTerm::class,'payment_term','id');
    }

    public function liftings()
    {
      return $this->hasMany(SaleContract::class,'contract_id','id');
    }

    public function allocations()
    {
        return $this->hasMany(VesselAllocation::class,'contract_id','id');
    }

    public function messages()
    {
        return $this->hasMany(MessageContract::class,'contract_id');
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

    public function balance_qty()
    {
        return $this->quantity - $this->liftings->sum('quantity');
    }

    public function unallocated_qty()
    {
        return number_format($this->quantity - $this->allocations->sum('quantity'),3);
    }

    public function allocated_qty()
    {
        return number_format($this->allocations->sum('quantity'),3);
    }

    public function lifting_status()
    {
        $lifted_qty = $this->liftings->sum('quantity');
        if ($lifted_qty > 0) {
            if ($lifted_qty == $this->quantity) {
                return 'Lifting Completed';
            }
            else {
                return 'Lifting in Progress'; 
            }
        }
        else {
            return 'Waiting for Lifting';
        }
    }
}