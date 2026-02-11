<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCheque extends Model
{
    use HasFactory;

    protected $table = 'payment_cheques';

    protected $fillable = [
        'custom_payment_id',
        'cheque_number',
        'amount',
        'clearing_date',
        'remarks'
    ];

    public function payment()
    {
        return $this->belongsTo(CustomPayment::class,'custom_payment_id','id');
    }
}
