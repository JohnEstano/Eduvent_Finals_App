<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
   use HasFactory;

    
    protected $fillable = [
        'name',
        'location',
        'date',
        'status',
        'requirement',
        'start_time',
        'end_time',
        'description',
        'created_by'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'created_by');
}

    public function createdBy()
{
    return $this->belongsTo(User::class, 'created_by', 'id');
}
    
}

