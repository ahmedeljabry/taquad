<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrackerReferer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tracker_referers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'domain_id',
        'url',
        'medium',
        'source',
        'search_terms_hash'
    ];


    /**
     * Get domain
     *
     * @return object
     */
    public function domain() : object
    {
        return $this->belongsTo(TrackerDomain::class, 'domain_id');
    }
}
