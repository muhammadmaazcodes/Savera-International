<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = ['journal_date','description'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model)  {
            if (auth()->check()) {
                $model->created_by = auth()->id();
            }
        });
    }
}