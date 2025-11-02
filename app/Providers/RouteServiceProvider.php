<?php

namespace App\Providers;

use App\Models\Contract;
use App\Models\TrackerClient;
use App\Models\TrackerProject;
use App\Models\TrackerProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        Route::model('tracker_client', TrackerClient::class);
        Route::model('tracker_project', TrackerProject::class);
        Route::model('tracker_project_member', TrackerProjectMember::class);
        Route::model('tracker_contract', Contract::class);

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::prefix(config('global.dashboard_prefix'))
                ->namespace('App\Livewire\Admin')
                ->group(base_path('routes/admin.php'));

            if (!isInstalled()) {
                
                Route::prefix('install')
                    ->middleware('web')
                    ->namespace('App\Livewire\Installation')
                    ->group(base_path('routes/install.php'));

            }
        });
    }
}
