<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleContract extends Model
{
    use HasFactory;
    protected $table = 'sales_contract';

    public function sales()
    {
        return $this->belongsTo(SalesRequest::class,'sale_id','id');    
    }

    public function contract()
    {
        return $this->belongsTo(LocalContract::class,'contract_id','id');    
    }

    public function vessel_allocation()
    {
        return $this->belongsTo(VesselAllocation::class,'vessel_allocation_id','id');    
    }
}
