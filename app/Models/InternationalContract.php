<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalContract extends Model
{
    use HasFactory;

    protected $table = 'international_contract';

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function buyer()
    {
        return $this->belongsTo(Company::class,'buyer_id','id');
    }

    public function seller()
    {
        return $this->belongsTo(Company::class,'seller_id','id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class,'business_id','id');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
