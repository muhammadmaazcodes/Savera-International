<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRequest extends Model
{
    use HasFactory;
    protected $table = 'sales_request';

    public function buyer()
    {
        return $this->belongsTo(Company::class,'buyer_id','id');    
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');    
    }

    public function terminal()
    {
        return $this->belongsTo(Terminal::class,'terminal_id','id');    
    }

    public function lifting_bls()
    {
        return $this->hasMany(LiftingBL::class,'sale_id');
    }

    public function loaded_qty()
    {
        return $this->lifting_bls()->sum('quantity');
    }

    public function sales_contracts()
    {
        return $this->hasMany(SaleContract::class,'sale_id');    
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id','id');    
    }
}
