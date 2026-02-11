<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAddress extends Model
{
    use HasFactory;

    protected $fillable = ['title','address','address2','city','country','email','phone','fax','website'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
