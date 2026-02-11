<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyAddress;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name','code','local','international','buyer','seller'];

    public function addresses()
    {
        return $this->hasMany(CompanyAddress::class);
    }

    public function contracts()
    {
        return $this->hasMany(LocalContract::class,'buyer_id','id');
    }
}
