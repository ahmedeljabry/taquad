<?php

namespace App\Models;

use App\Enums\ContractStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id','client_id','freelancer_id','type','status','hourly_rate','weekly_limit_hours','started_at','ended_at',
    ];

    protected $casts = [
        'status'      => ContractStatus::class,
        'started_at'  => 'datetime',
        'ended_at'    => 'datetime',
        'hourly_rate' => 'decimal:2',
    ];

    public function project() { return $this->belongsTo(Project::class); }
    public function client() { return $this->belongsTo(User::class, 'client_id'); }
    public function freelancer() { return $this->belongsTo(User::class, 'freelancer_id'); }
    public function time_entries() { return $this->hasMany(TimeEntry::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
}

