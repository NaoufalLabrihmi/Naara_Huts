<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HutNumber extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function hut_type()
    {
        return $this->belongsTo(HutType::class, 'hut_type_id');
    }

    public function last_booking()
    {
        return $this->hasOne(BookingHutList::class, 'hut_number_id')->latest();
    }
}
