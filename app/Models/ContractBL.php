<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractBL extends Model
{
    use HasFactory;

    protected $table = 'contract_bl';

    public function bl()
    {
        return $this->belongsTo(InventoryBL::class,'inventorybl_id','id');
    }

    public function contract()
    {
        return $this->belongsTo(LocalContract::class,'contract_id','id');
    }
}
