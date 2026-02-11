<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageContract extends Model
{
    use HasFactory;

    protected $table = 'message_contract';

    public function contract()
    {
        return $this->belongsTo(LocalContract::class,'contract_id');
    }
}
