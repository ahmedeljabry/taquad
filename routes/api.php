<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\TrackerOAuthTokenController;
use App\Http\Controllers\Api\Tracker\Admin\ClientController as TrackerAdminClientController;
use App\Http\Controllers\Api\Tracker\Admin\ContractController as TrackerAdminContractController;
use App\Http\Controllers\Api\Tracker\Admin\ProjectController as TrackerAdminProjectController;
use App\Http\Controllers\Api\Tracker\ContractController;
use App\Http\Controllers\Api\Tracker\HealthController;
use App\Http\Controllers\Api\Tracker\ProfileController;
use App\Http\Controllers\Api\Tracker\SegmentController;
use App\Http\Controllers\Api\Tracker\ScreenshotController;
use App\Http\Controllers\Api\TaquadAssistantController;

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

Route::post('assistant/chat', [TaquadAssistantController::class, 'chat'])->name('assistant.chat');

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

Route::prefix('tracker/admin')
    ->name('tracker.admin.')
    ->middleware(['auth:sanctum', 'abilities:tracker:manage'])
    ->group(function () {
        Route::apiResource('clients', TrackerAdminClientController::class)->parameters(['clients' => 'tracker_client']);
        Route::apiResource('projects', TrackerAdminProjectController::class)->parameters(['projects' => 'tracker_project']);
        Route::post('projects/{tracker_project}/members', [TrackerAdminProjectController::class, 'storeMember'])
            ->name('projects.members.store');
        Route::delete('projects/{tracker_project}/members/{tracker_project_member}', [TrackerAdminProjectController::class, 'destroyMember'])
            ->name('projects.members.destroy');
        Route::apiResource('contracts', TrackerAdminContractController::class)
            ->except(['destroy'])
            ->parameters(['contracts' => 'tracker_contract']);
        Route::post('contracts/{tracker_contract}/status', [TrackerAdminContractController::class, 'changeStatus'])
            ->name('contracts.change-status');
    });
