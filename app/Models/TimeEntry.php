<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id','started_at','ended_at','duration_minutes','memo','activity_score',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at'   => 'datetime',
    ];

    public function contract() { return $this->belongsTo(Contract::class); }
    public function snapshots() { return $this->hasMany(TimeSnapshot::class); }
}

