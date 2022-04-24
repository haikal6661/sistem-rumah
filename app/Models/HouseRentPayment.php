<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseRentPayment extends Model
{
    use HasFactory;

    protected $casts = [
        'is_paid' => 'boolean',
    ];

    protected $fillable = [
        'user_id',
        'house_rent_id',
        'amount_to_pay',
        'paid_on',
    ];
}
