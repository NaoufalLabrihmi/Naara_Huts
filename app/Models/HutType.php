<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HutType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function hut()
    {
        return $this->belongsTo(Hut::class, 'id', 'huttype_id');
    }
}
