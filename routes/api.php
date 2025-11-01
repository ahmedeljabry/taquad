<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\TrackerOAuthTokenController;
use App\Http\Controllers\Api\Tracker\ContractController;
use App\Http\Controllers\Api\Tracker\HealthController;
use App\Http\Controllers\Api\Tracker\ProfileController;
use App\Http\Controllers\Api\Tracker\SegmentController;
use App\Http\Controllers\Api\Tracker\ScreenshotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('tracker')->name('tracker.')->group(function () {
    Route::match(['get', 'head'], 'healthz', HealthController::class)->name('healthz');

    Route::post('login', [LoginController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login');

    Route::middleware(['auth:sanctum', 'abilities:tracker:use'])->group(function () {
        Route::get('profile', ProfileController::class)->name('profile.show');
        Route::get('contracts', [ContractController::class, 'index'])->name('contracts.index');
        Route::post('segments', [SegmentController::class, 'store'])->name('segments.store');
        Route::post('screenshots', [ScreenshotController::class, 'store'])->name('screenshots.store');
    });
});
