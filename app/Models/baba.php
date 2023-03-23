<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baba extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'weight',
        'price',
        'date',
        'customer_id'
    ];
}
