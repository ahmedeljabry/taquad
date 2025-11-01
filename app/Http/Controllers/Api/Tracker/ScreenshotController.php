<?php

namespace App\Http\Controllers\Api\Tracker;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\TimeEntry;
use App\Models\TimeSnapshot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ScreenshotController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'contract_id' => ['required', 'integer', 'exists:contracts,id'],
            'started_at'  => ['required', 'date'],
            'file'        => ['required', 'file', 'image', 'max:5120'],
        ]);

        $contract = Contract::query()
            ->where('id', $data['contract_id'])
            ->where('freelancer_id', $user->id)
            ->first();

        if (! $contract) {
            throw ValidationException::withMessages([
                'contract_id' => [__('messages.t_contract_not_found_or_inactive')],
            ]);
        }

        $entry = TimeEntry::query()
            ->where('contract_id', $contract->id)
            ->where('user_id', $user->id)
            ->where('started_at', $data['started_at'])
            ->first();

        if (! $entry) {
            throw ValidationException::withMessages([
                'started_at' => [__('messages.t_time_entry_not_found_for_screenshot')],
            ]);
        }

        $disk = config('filesystems.default', 'public');
        $path = $request->file('file')->store("tracker/screenshots/{$user->id}", $disk);

        TimeSnapshot::create([
            'time_entry_id' => $entry->id,
            'image_path'    => $path,
            'captured_at'   => $entry->ended_at ?? now(),
            'disk'          => $disk,
        ]);

        $entry->has_screenshot = true;
        $entry->save();

        return response()->json([
            'path' => Storage::disk($disk)->url($path),
        ]);
    }
}
