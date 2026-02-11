<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiftingBLCommingle extends Model
{
    use HasFactory;

    protected $table = 'lifting_bl_commingle';
    protected $fillable = ['lifting_bl_id','quantity'];

    public function lifting_bl()
    {
        return $this->belongsTo(LiftingBL::class,'lifting_bl_id','id');
    }
}
