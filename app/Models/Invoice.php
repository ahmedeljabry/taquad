<?php

namespace App\Models;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id','week_start_date','week_end_date','total_minutes','total_amount','status',
    ];

    protected $casts = [
        'week_start_date' => 'date',
        'week_end_date'   => 'date',
        'status'          => InvoiceStatus::class,
        'total_amount'    => 'decimal:2',
    ];

    public function contract() { return $this->belongsTo(Contract::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function disputes() { return $this->hasMany(Dispute::class); }
}

