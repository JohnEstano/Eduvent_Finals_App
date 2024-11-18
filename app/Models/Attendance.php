<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'event_name',
        'time_in',
        'timein_photo',
        'time_out',
        'timeout_photo',
        'remarks',
        'status',
        'location',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}