<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiftingBL extends Model
{
    use HasFactory;
    protected $table = 'lifting_bl';

    public function lifting()
    {
        return $this->belongsTo(SalesRequest::class,'sale_id','id');
    } 

    public function bl()
    {
        return $this->belongsTo(InventoryBL::class,'bl_id','id');
    }

    public function commingle()
    {
        return $this->hasOne(LiftingBLCommingle::class,'lifting_bl_id');
    }
}
