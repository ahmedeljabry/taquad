<?php

namespace App\Http\Controllers\Api\Tracker;

use App\Http\Controllers\Controller;

class HealthController extends Controller
{
    /**
     * Simple health-check endpoint for the desktop tracker.
     */
    public function __invoke()
    {
        return response()->noContent();
    }
}
