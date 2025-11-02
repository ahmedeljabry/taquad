<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNotificationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'channels',
        'dnd',
        'digest_enabled',
    ];

    protected $casts = [
        'channels'       => 'array',
        'dnd'            => 'array',
        'digest_enabled' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function allowsChannel(string $channel): bool
    {
        $channels = $this->channels ?? [];

        return empty($channels) || in_array($channel, $channels, true);
    }

    public function isDndActive(?CarbonInterface $now = null): bool
    {
        $window = $this->dnd ?? [];

        if (! isset($window['start'], $window['end'])) {
            return false;
        }

        $tz = $window['tz'] ?? config('app.timezone');
        $now = ($now ?? now())->setTimezone($tz);

        $start = CarbonImmutable::parse($window['start'], $tz)->setDate($now->year, $now->month, $now->day);
        $end = CarbonImmutable::parse($window['end'], $tz)->setDate($now->year, $now->month, $now->day);

        if ($end->lessThanOrEqualTo($start)) {
            $end = $end->addDay();
        }

        $current = CarbonImmutable::create(
            $now->year,
            $now->month,
            $now->day,
            $now->hour,
            $now->minute,
            0,
            $tz
        );

        if ($current->lessThan($start)) {
            $start = $start->subDay();
            $end = $end->subDay();
        }

        return $current->betweenIncluded($start, $end);
    }
}
