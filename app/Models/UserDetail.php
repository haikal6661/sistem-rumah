<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserDetail extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'phone_no',
        'user_id',
        'age',
        'birth_place',
        'education',
        'profession',
        'workplace',
        'about',
        'picture',
    ];

    public function details()
    {
        return $this->belongsTo(User::class);
    }
}
