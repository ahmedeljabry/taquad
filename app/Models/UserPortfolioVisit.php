<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPortfolioVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'user_id',
        'visitor_hash',
    ];

    public function portfolio()
    {
        return $this->belongsTo(UserPortfolio::class, 'portfolio_id');
    }

    public function visitor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

