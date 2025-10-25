<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id','amount','provider','provider_ref','status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'status' => PaymentStatus::class,
    ];

    public function invoice() { return $this->belongsTo(Invoice::class); }
}

