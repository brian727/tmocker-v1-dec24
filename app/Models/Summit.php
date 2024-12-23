<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Summit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'temp',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'temp' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $appends = ['duration'];

    public function getDurationAttribute()
    {
        return $this->start_time && $this->end_time
            ? $this->start_time->diffInMinutes($this->end_time)
            : null;
    }
}
