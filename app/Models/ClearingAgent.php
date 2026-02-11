<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearingAgent extends Model
{
    use HasFactory;

    protected $fillable = ['title','name','code','address','city','country','email','phone','contact_person','contact_number'];

}
