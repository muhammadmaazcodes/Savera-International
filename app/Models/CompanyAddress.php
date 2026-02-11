<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    use HasFactory;

    protected $fillable = ['title','address','address2','city','country','email','phone','fax','website'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
