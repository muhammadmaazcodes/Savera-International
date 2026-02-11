<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class COA extends Model
{
    use HasFactory;

    protected $table = 'chart_of_accounts';

    protected $fillable = [
        'acode',
        'aname',
        'aopening_balance',
        'opening_date',
        'system_account',
        'branch_code',
        'user_id',
        'alevel',
        'del_status',
        'contra_codeIs_there',
        'contra_account_aode',
        'account_id',
        'postable'
    ];
}
