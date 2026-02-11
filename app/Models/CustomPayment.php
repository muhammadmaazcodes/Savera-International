<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPayment extends Model
{
    use HasFactory;

    protected $table = 'custom_payments';

    protected $fillable = [
        'type',
        'customer_number',
        'buyer_id',
        'posting_date',
        'inventory_id',
        'bank_branch',
        'ibft',
        'bank_id',
        'bank_acc_title',
        'deposit_slip_number',
        'stamp_date',
        'attachment_deposit_slip',
        'amount',
        'remarks',
        'settlement_name',
        'status'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function bank()
    {
        return $this->belongsTo(BankAccount::class,'bank_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(Company::class,'buyer_id','id');
    }

    public function cheques()
    {
        return $this->hasOne(PaymentCheque::class);
    }

    public function getTypeAttribute($value)
    {
        return ucwords(str_replace("_", " ", $value));
    }

}
