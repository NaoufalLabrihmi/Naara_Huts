<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHutList extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function hut_number()
    {
        return $this->belongsTo(HutNumber::class, 'hut_number_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
