<?php

namespace App\Models;

use App\Enums\DisputeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id','raised_by','reason','status',
    ];

    protected $casts = [
        'status' => DisputeStatus::class,
    ];

    public function invoice() { return $this->belongsTo(Invoice::class); }
}

