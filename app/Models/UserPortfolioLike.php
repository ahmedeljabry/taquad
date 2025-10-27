<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPortfolioLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'user_id',
    ];

    public function portfolio()
    {
        return $this->belongsTo(UserPortfolio::class, 'portfolio_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

