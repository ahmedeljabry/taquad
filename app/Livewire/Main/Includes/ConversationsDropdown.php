<?php

namespace App\Livewire\Main\Includes;

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class ConversationsDropdown extends Component
{
    protected $listeners = [
        'conversations:refresh' => 'refreshConversations',
    ];

    /**
     * Latest conversations keyed by counterpart.
     */
    public Collection $conversations;

    /**
     * Number of unread messages across all conversations.
     */
    public int $unreadTotal = 0;

    /**
     * Component boot.
     */
    public function mount(): void
    {
        $this->refreshConversations();
    }

    /**
     * Render dropdown view.
     */
    public function render(): View
    {
        return view('livewire.main.includes.conversations-dropdown');
    }

    /**
     * Refresh list when realtime event fired.
     */
    public function refreshConversations(): void
    {
        $userId = Auth::id();

        if (! $userId) {
            $this->conversations = collect();
            $this->unreadTotal   = 0;

            return;
        }

        $conversations = Conversation::query()
            ->with([
                'participants.user:id,username,fullname,avatar_id',
                'lastMessage.sender:id,username,fullname,avatar_id',
                'project:id,title,slug',
            ])
            ->whereHas('participants', fn ($query) => $query->where('user_id', $userId))
            ->orderByDesc('last_message_at')
            ->orderByDesc('id')
            ->limit(20)
            ->get();

        $unreadTotal = 0;

        $this->conversations = $conversations->map(function (Conversation $conversation) use ($userId, &$unreadTotal) {
            $currentParticipant = $conversation->participants
                ->firstWhere('user_id', $userId);

            $counterpart = $conversation->participants
                ->firstWhere('user_id', '!=', $userId)
                ?? $conversation->participants->first();

            $counterpartUser = optional($counterpart)->user;

            $lastMessage = $conversation->lastMessage;

            $preview = $lastMessage?->body
                ? Str::of(strip_tags($lastMessage->body))->squish()->limit(90)->toString()
                : __('messages.t_no_message_preview');

            $unread = $currentParticipant?->unread_count ?? 0;
            $unreadTotal += $unread;

            return [
                'id'        => $conversation->id,
                'uid'       => $conversation->uid,
                'user'      => $counterpartUser,
                'preview'   => $preview,
                'project'   => $conversation->project,
                'timestamp' => $conversation->last_message_at,
                'time_human'=> optional($conversation->last_message_at)->diffForHumans(),
                'link'      => route('messages.inbox', $conversation->uid),
                'unread'    => $unread,
            ];
        })->filter(fn (array $conversation) => $conversation['user'])
            ->sortByDesc(fn (array $conversation) => optional($conversation['timestamp'])->timestamp ?? 0)
            ->take(5)
            ->values();

        $this->unreadTotal = $unreadTotal;
    }

    public function getListeners(): array
    {
        $listeners = $this->listeners;

        if ($userId = Auth::id()) {
            $listeners["echo-private:user.{$userId},message.sent"] = 'refreshConversations';
        }

        return $listeners;
    }

    /**
     * Mark a conversation as read.
     */
    public function markAsRead(string $conversationUid): void
    {
        $userId = Auth::id();

        if (! $userId) {
            return;
        }

        $conversation = Conversation::query()
            ->where('uid', $conversationUid)
            ->first();

        if (! $conversation) {
            return;
        }

        ConversationParticipant::query()
            ->where('conversation_id', $conversation->id)
            ->where('user_id', $userId)
            ->update([
                'unread_count' => 0,
                'last_read_at' => now(),
            ]);

        $this->refreshConversations();
    }
}
