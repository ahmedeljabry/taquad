<?php

namespace App\Models;

use App\Enums\ProposalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id','freelancer_id','cover_letter','hourly_rate','status',
    ];

    protected $casts = [
        'status'      => ProposalStatus::class,
        'hourly_rate' => 'decimal:2',
    ];

    public function project() { return $this->belongsTo(Project::class); }
    public function freelancer() { return $this->belongsTo(User::class, 'freelancer_id'); }
}

