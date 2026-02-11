<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = ['date','buyer_id','voyage','vessel_id','payment_mode','branch','bank_code','ac_title','amount','cheque_number','slip_number','remarks','status'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'vessel_id','id');
    }

    public function buyer()
    {
        return $this->belongsTo(Company::class,'buyer_id','id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentTerm::class,'payment_mode','id');
    }
}
