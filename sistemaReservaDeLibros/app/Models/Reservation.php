<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Define la relación con el usuario que hizo la reserva.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->hasOne(Books::class);
    }
}
