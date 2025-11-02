<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackerClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'company_name',
        'contact_email',
        'contact_phone',
        'timezone',
        'currency_code',
        'billing_preferences',
        'notes',
    ];

    protected $casts = [
        'billing_preferences' => 'array',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projects()
    {
        return $this->hasMany(TrackerProject::class);
    }
}

