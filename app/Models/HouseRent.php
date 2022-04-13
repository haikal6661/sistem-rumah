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
        'created_by',
        'bill_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
