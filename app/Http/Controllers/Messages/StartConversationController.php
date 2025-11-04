<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StartConversationController extends Controller
{
    public function __invoke(Request $request, string $username, ?string $projectId = null): RedirectResponse
    {
        $authUser = Auth::user();

        abort_unless($authUser, 403);

        $target = User::query()
            ->where('username', $username)
            ->whereIn('status', ['active', 'verified'])
            ->firstOrFail();

        if ($target->id === $authUser->id) {
            return redirect()->route('messages.inbox');
        }

        $project = null;

        if ($projectId) {
            $project = Project::query()
                ->where('id', $projectId)
                ->select('id')
                ->first();
        }

        $conversation = DB::transaction(function () use ($authUser, $target, $project) {
            $query = Conversation::query();

            if ($project) {
                $query->where('project_id', $project->id);
            } else {
                $query->whereNull('project_id');
            }

            $query->whereHas('participants', function ($builder) use ($authUser) {
                $builder->where('user_id', $authUser->id);
            })->whereHas('participants', function ($builder) use ($target) {
                $builder->where('user_id', $target->id);
            });

            $conversation = $query->first();

            if (! $conversation) {
                $conversation = Conversation::create([
                    'project_id' => $project?->id,
                    'created_by' => $authUser->id,
                    'last_message_at' => now(),
                ]);
            }

            $participants = [
                $authUser->id => true,
                $target->id => false,
            ];

            foreach ($participants as $userId => $markAsRead) {
                $participant = ConversationParticipant::firstOrCreate(
                    [
                        'conversation_id' => $conversation->id,
                        'user_id' => $userId,
                    ],
                    [
                        'joined_at' => now(),
                    ]
                );

                if ($markAsRead) {
                    $participant->forceFill([
                        'last_read_at' => now(),
                        'unread_count' => 0,
                    ])->save();
                }
            }

            return $conversation->fresh(['participants']);
        });

        return redirect()->route('messages.inbox', [
            'conversation' => $conversation->uid,
        ]);
    }
}
