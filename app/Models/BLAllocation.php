<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BLAllocation extends Model
{
    use HasFactory;

    protected $table = 'bl_allocations';

    public function bl()
    {
        return $this->belongsTo(InventoryBL::class,'bl_id','id');
    }
}
