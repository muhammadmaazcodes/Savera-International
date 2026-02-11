<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BusinessAddress;

class Business extends Model
{
    use HasFactory;

    protected $fillable = ['name','code','local','international'];

    public function addresses()
    {
        return $this->hasMany(BusinessAddress::class);
    }
}
