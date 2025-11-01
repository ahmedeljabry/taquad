<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSnapshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_entry_id',
        'image_path',
        'disk',
        'captured_at',
    ];

    protected $casts = [
        'captured_at' => 'datetime',
    ];

    public function entry() { return $this->belongsTo(TimeEntry::class, 'time_entry_id'); }
}
