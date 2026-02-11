<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommingleBL extends Model
{
    use HasFactory;

    protected $table = 'commingle_bls';

    public function bl()
    {
        return $this->belongsTo(InventoryBL::class);
    }

    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }
}
