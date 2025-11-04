<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogLivewire
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->is(['livewire/update', 'taquad/livewire/update'])) {
            logger()->info('livewire.middleware', [
                'uri' => $request->getRequestUri(),
                'status' => $response->getStatusCode(),
            ]);
        }

        return $response;
    }
}
