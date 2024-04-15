<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function assign_huts()
    {
        return $this->hasMany(BookingHutList::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hut()
    {
        return $this->belongsTo(Hut::class, 'huts_id', 'id');
    }
}
