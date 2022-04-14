<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class HouseRent extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'amount',
        'user_id',
        'created_by',
        'bill_image',
        'path',
        'month',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
