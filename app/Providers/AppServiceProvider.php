<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->forceHttpsWhenBehindProxy();

        Schema::defaultStringLength(191);

        try {
            Schema::disableForeignKeyConstraints();
        } catch (\Throwable $th) {
        }

        Blade::withoutDoubleEncoding();
    }

    /**
     * Force generated URLs to HTTPS when the original request already arrived via HTTPS.
     */
    protected function forceHttpsWhenBehindProxy(): void
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        $forceHttps = config('app.force_https_urls');

        if ($forceHttps === null) {
            $forceHttps = $this->app->environment('production');
        }

        if (!$forceHttps || is_localhost()) {
            return;
        }

        try {
            $request = request();

            if ($this->isHttpsRequest($request)) {
                URL::forceScheme('https');
            }
        } catch (\Throwable $th) {
            error_log($th->getMessage());
        }
    }

    /**
     * Determine if the incoming request was HTTPS at the edge or proxy.
     */
    protected function isHttpsRequest(Request $request): bool
    {
        if ($request->secure()) {
            return true;
        }

        $protoHeaders = [
            $request->header('X-Forwarded-Proto'),
            $request->server('HTTP_X_FORWARDED_PROTO'),
            $request->server('HTTP_X_FORWARDED_SCHEME'),
            $request->server('REQUEST_SCHEME'),
        ];

        foreach ($protoHeaders as $value) {
            if ($this->valueEqualsHttps($value)) {
                return true;
            }
        }

        $forwarded = strtolower((string) $request->server('HTTP_FORWARDED'));

        if ($forwarded && Str::contains($forwarded, 'proto=https')) {
            return true;
        }

        $cfVisitor = $request->server('HTTP_CF_VISITOR');

        if ($cfVisitor) {
            $decoded = json_decode($cfVisitor, true);

            if (($decoded['scheme'] ?? null) === 'https') {
                return true;
            }
        }

        $forwardedSsl = $request->server('HTTP_X_FORWARDED_SSL');
        $frontEndHttps = $request->server('HTTP_FRONT_END_HTTPS');

        return $this->valueIndicatesOn($forwardedSsl) || $this->valueIndicatesOn($frontEndHttps);
    }

    protected function valueEqualsHttps(?string $value): bool
    {
        return strtolower((string) $value) === 'https';
    }

    protected function valueIndicatesOn(?string $value): bool
    {
        return in_array(strtolower((string) $value), ['on', '1', 'https'], true);
    }
}
