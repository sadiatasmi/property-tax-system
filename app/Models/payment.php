<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'transaction_id',
        'month',
        'year',
        'active',
        'holding_number',
        'amount',
    ];

}
