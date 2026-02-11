<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = ['name','account_title','bank_name','account_number','iban','swift','bank_branch_name','bank_branch_address','bank_branch_code','branch_zip'];
}
