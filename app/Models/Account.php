<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['id','account_name','account_type','parent_account_id'];

    public function parent()
    {
        return $this->belongsTo(Account::class,'parent_account_id','id');
    }

    public function children()
    {
        return $this->hasMany(Account::class,'parent_account_id','id');
    }
}
