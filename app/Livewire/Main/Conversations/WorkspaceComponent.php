<?php

namespace App\Livewire\Main\Conversations;

use App\Events\MessageRead;
use App\Events\TypingStarted;
use App\Events\TypingStopped;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Message;
use App\Services\Messaging\MessageService;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class WorkspaceComponent extends Component
{
    use SEOToolsTrait;
    use LivewireAlert;
    use WithFileUploads;

    #[Url(as: 'conversation', except: '')]
    public ?string $conversationUid = null;

    public string $messageBody = '';

    /**
     * @var array<int, \Livewire\Features\SupportFileUploads\TemporaryUploadedFile>
     */
    public array $uploadQueue = [];

    /**
     * Sidebar conversation cards.
     *
     * @var array<int, array<string, mixed>>
     */
    public array $conversations = [];

    /**
     * Active conversation messages ordered ascending.
     *
     * @var array<int, array<string, mixed>>
     */
    public array $messages = [];

    /**
     * Participants metadata for the active conversation.
     *
     * @var array<int, array<string, mixed>>
     */
    public array $participants = [];

    /**
     * Typing indicators keyed by user id.
     *
     * @var array<int, array<string, mixed>>
     */
    public array $typing = [];

    /**
     * Search keyword for the conversation list.
     */
    public string $search = '';

    /**
     * Details about the currently opened conversation.
     *
     * @var array<string, mixed>
     */
    public array $activeConversation = [];

    public ?int $activeConversationId = null;
    public bool $hasMoreMessages = false;

    protected ?int $oldestMessageId = null;
    protected ?int $latestMessageId = null;
    protected array $participantStates = [];
    protected ?int $userId = null;
    protected ?Carbon $lastTypingBroadcastAt = null;
    protected bool $composerTyping = false;

    protected int $messagesPerPage = 30;

    protected MessageService $messaging;

    public function boot(MessageService $messaging): void
    {
        $this->messaging = $messaging;
    }

    public function mount(?string $conversation = null): void
    {
        $this->userId = Auth::id();

        abort_unless($this->userId, 403);

        $this->conversationUid = $conversation ?: $this->conversationUid;

        $this->hydrateState();
    }

    public function hydrate(): void
    {
        $this->userId = Auth::id();

        abort_unless($this->userId, 403);
    }

    public function getListeners(): array
    {
        $listeners = [
            'refreshConversations' => 'refreshConversations',
        ];

        if ($this->activeConversationId) {
            $listeners["echo-presence:presence.conversation.{$this->activeConversationId},message.sent"] = 'handleBroadcastMessage';
            $listeners["echo-private:private.reads.conversation.{$this->activeConversationId},message.read"] = 'handleBroadcastRead';
            $listeners["echo-private:private.typing.conversation.{$this->activeConversationId},typing.started"] = 'handleTypingStarted';
            $listeners["echo-private:private.typing.conversation.{$this->activeConversationId},typing.stopped"] = 'handleTypingStopped';
        }

        if ($this->userId) {
            $listeners["echo-private:private.deliveries.user.{$this->userId},message.delivered"] = 'handleBroadcastDelivery';
        }

        return $listeners;
    }

    #[Layout('components.layouts.main-app')]
    public function render(): View
    {
        $this->applySeo();

        return view('livewire.main.conversations.workspace');
    }

    public function selectConversation(string $uid): void
    {
        $match = collect($this->conversations)->firstWhere('uid', $uid);

        if (! $match) {
            return;
        }

        $this->conversationUid = $uid;
        $this->setActiveConversation((int) $match['id']);
        $this->dispatch('chat:scroll-bottom');
    }

    public function loadMoreMessages(): void
    {
        $this->loadMessages(reset: false);
    }

    public function updatedSearch(): void
    {
        $this->hydrateState(keepMessages: true);
    }

    public function updatedMessageBody(string $value): void
    {
        $trimmed = trim($value);

        if ($trimmed === '') {
            $this->broadcastTypingStopped();

            return;
        }

        $now = Carbon::now();

        if (! $this->composerTyping || $this->lastTypingBroadcastAt === null || $this->lastTypingBroadcastAt->lte($now->clone()->subSeconds(6))) {
            $this->broadcastTypingStarted();
        }

        $this->composerTyping = true;
        $this->lastTypingBroadcastAt = $now;
    }

    public function updatedUploadQueue(): void
    {
        if (count($this->uploadQueue) <= 5) {
            return;
        }

        $this->uploadQueue = array_slice($this->uploadQueue, 0, 5);
        $this->alert('warning', 'يمكنك إرفاق حتى 5 ملفات فقط في كل رسالة.');
    }

    public function removeUpload(int $index): void
    {
        if (! isset($this->uploadQueue[$index])) {
            return;
        }

        unset($this->uploadQueue[$index]);
        $this->uploadQueue = array_values($this->uploadQueue);
    }

    public function sendMessage(): void
    {
        if (! $this->activeConversationId || ! $this->userId) {
            return;
        }

        logger()->info('WorkspaceComponent@sendMessage:start', [
            'conversation_id' => $this->activeConversationId,
            'user_id' => $this->userId,
        ]);

        $this->validate([
            'messageBody' => ['nullable', 'string', 'max:5000'],
            'uploadQueue' => ['array', 'max:5'],
            'uploadQueue.*' => ['file', 'max:10240'],
        ]);

        $body = trim($this->messageBody);
        $attachments = $this->uploadQueue;

        if ($body === '' && empty($attachments)) {
            return;
        }

        // Clear composer immediately for optimistic UI
        $this->resetComposer();

        $conversation = Conversation::query()
            ->with('participants')
            ->find($this->activeConversationId);

        if (! $conversation) {
            $this->alert('error', __('messages.t_conversation_not_found'));

            return;
        }

        $sender = Auth::user();

        abort_unless($sender, 403);

        try {
            $message = $this->messaging->send($conversation, $sender, $body, $attachments);
        } catch (\Throwable $exception) {
            report($exception);
            $this->alert('error', __('messages.t_err_something_went_wrong'));

            return;
        }

        logger()->info('WorkspaceComponent@sendMessage:stored', [
            'message_id' => $message->id,
            'conversation_id' => $this->activeConversationId,
        ]);

        $message->loadMissing(['sender:id,username,fullname,avatar_id', 'attachments']);

        $this->messages[] = $this->transformMessage($message);
        $this->messages = collect($this->messages)->sortBy('id')->values()->all();
        $this->latestMessageId = $message->id;

        $this->dispatch('chat:scroll-bottom');
        $this->refreshConversations();
    }

    public function refreshConversations(): void
    {
        $this->hydrateState(keepMessages: true);
    }

    public function pollRealtime(): void
    {
        if (! $this->activeConversationId) {
            return;
        }

        $this->refreshConversations();

        $query = Message::query()
            ->with(['sender:id,username,fullname,avatar_id', 'attachments'])
            ->where('conversation_id', $this->activeConversationId)
            ->orderByDesc('id');

        if ($this->latestMessageId) {
            $query->where('id', '>', $this->latestMessageId);
        }

        $newMessages = $query->limit($this->messagesPerPage)->get()->reverse();

        if ($newMessages->isEmpty()) {
            return;
        }

        $existingIds = collect($this->messages)
            ->pluck('id')
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->flip();

        $added = false;

        foreach ($newMessages as $message) {
            if ($existingIds->has($message->id)) {
                continue;
            }

            $transformed = $this->transformMessage($message);
            $this->messages[] = $transformed;
            $existingIds->put($message->id, true);
            $added = true;

            $this->updateConversationPreviewFromBroadcast($transformed);
        }

        if (! $added) {
            return;
        }

        $this->messages = collect($this->messages)
            ->sortBy('id')
            ->values()
            ->all();

        $this->latestMessageId = collect($this->messages)
            ->pluck('id')
            ->filter()
            ->max() ?? $this->latestMessageId;

        $this->dispatch('chat:scroll-bottom');
        $this->markConversationAsRead($this->latestMessageId);
    }

    public function handleBroadcastMessage(array $payload): void
    {
        $conversationId = (int) ($payload['conversation_id'] ?? 0);
        $message = $this->normalizeBroadcastMessage($payload);

        $this->updateConversationPreviewFromBroadcast($message);

        if ($conversationId !== $this->activeConversationId) {
            return;
        }

        $existingIndex = collect($this->messages)->search(fn (array $item) => $item['id'] === $message['id']);

        if ($existingIndex === false) {
            $this->messages[] = $message;
        } else {
            $this->messages[$existingIndex] = $message;
        }

        $this->messages = collect($this->messages)->sortBy('id')->values()->all();
        $this->latestMessageId = $message['id'];

        if ((int) ($payload['message']['user_id'] ?? 0) !== $this->userId) {
            $this->markConversationAsRead($message['id']);
            foreach ($this->messages as &$item) {
                if (($item['id'] ?? null) === $message['id']) {
                    $item['is_new'] = false;
                    break;
                }
            }
            unset($item);
        }

        $this->dispatch('chat:scroll-bottom');
    }

    public function handleBroadcastDelivery(array $payload): void
    {
        $messageId = (int) ($payload['message_id'] ?? 0);

        if (! $messageId) {
            return;
        }

        $deliveredAt = $payload['delivered_at'] ?? null;

        foreach ($this->messages as &$message) {
            if ($message['id'] !== $messageId) {
                continue;
            }

            $message['state'] = 'delivered';
            $message['delivered_at'] = $deliveredAt;
        }

        unset($message);
    }

    public function handleBroadcastRead(array $payload): void
    {
        $conversationId = (int) ($payload['conversation_id'] ?? 0);
        $messageId = (int) ($payload['message_id'] ?? 0);
        $readerId = (int) ($payload['reader_id'] ?? 0);

        if ($conversationId !== $this->activeConversationId || ! $messageId || ! $readerId || $readerId === $this->userId) {
            return;
        }

        $this->participantStates[$readerId]['last_read_message_id'] = $messageId;
        $readAt = $payload['read_at'] ?? now()->toIso8601String();
        $this->participantStates[$readerId]['last_seen_at'] = $readAt;
        $this->participantStates[$readerId]['last_read_at'] = $readAt;

        foreach ($this->messages as &$message) {
            if (! $message['from_me'] || $message['id'] > $messageId) {
                continue;
            }

            $message['state'] = 'read';
        }

        unset($message);
    }

    public function handleTypingStarted(array $payload): void
    {
        $userId = (int) ($payload['user_id'] ?? 0);

        if (! $userId || $userId === $this->userId) {
            return;
        }

        $participant = $this->participantStates[$userId] ?? null;

        $this->typing[$userId] = [
            'id' => $userId,
            'name' => $participant['name'] ?? __('messages.t_user'),
            'since' => now()->toIso8601String(),
        ];
    }

    public function handleTypingStopped(array $payload): void
    {
        $userId = (int) ($payload['user_id'] ?? 0);

        if (! $userId) {
            return;
        }

        unset($this->typing[$userId]);
    }

    protected function applySeo(): void
    {
        $separator = settings('general')->separator;
        $title = __('messages.t_messages') . " $separator " . settings('general')->title;
        $description = settings('seo')->description;
        $ogimage = src(settings('seo')->ogimage);

        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $this->seo()->setCanonical(url()->current());
        $this->seo()->opengraph()->setTitle($title);
        $this->seo()->opengraph()->setDescription($description);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->setType('website');
        $this->seo()->opengraph()->addImage($ogimage);
        $this->seo()->twitter()->setImage($ogimage);
        $this->seo()->twitter()->setUrl(url()->current());
        $this->seo()->twitter()->setSite('@' . settings('seo')->twitter_username);
        $this->seo()->twitter()->addValue('card', 'summary_large_image');
        $this->seo()->metatags()->addMeta('fb:page_id', settings('seo')->facebook_page_id, 'property');
        $this->seo()->metatags()->addMeta('fb:app_id', settings('seo')->facebook_app_id, 'property');
        $this->seo()->metatags()->addMeta('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1', 'name');
        $this->seo()->jsonLd()->setTitle($title);
        $this->seo()->jsonLd()->setDescription($description);
        $this->seo()->jsonLd()->setUrl(url()->current());
        $this->seo()->jsonLd()->setType('WebSite');
    }

    protected function hydrateState(bool $keepMessages = false): void
    {
        $activeIdBefore = $this->activeConversationId;

        $records = $this->fetchConversations();
        $this->conversations = $records;
        $this->dispatchUnreadCount();

        if (empty($records)) {
            $this->activeConversationId = null;
            $this->activeConversation = [];
            $this->messages = [];
            $this->participants = [];

            return;
        }

        $target = collect($records)->firstWhere('uid', $this->conversationUid)
            ?? collect($records)->firstWhere('id', $activeIdBefore)
            ?? $records[0];

        $shouldPreserveMessages = $keepMessages && $activeIdBefore === $target['id'];

        $this->setActiveConversation((int) $target['id'], preserveMessages: $shouldPreserveMessages);
    }

    protected function fetchConversations(): array
    {
        if (! $this->userId) {
            return [];
        }

        $search = trim($this->search);

        $conversations = Conversation::query()
            ->with([
                'participants.user:id,username,fullname,avatar_id',
                'lastMessage.sender:id,username,fullname,avatar_id',
                'project:id,title,slug',
            ])
            ->whereHas('participants', fn ($query) => $query->where('user_id', $this->userId))
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('uid', 'like', '%' . $search . '%')
                        ->orWhereHas('participants.user', function ($nested) use ($search) {
                            $nested->where('fullname', 'like', '%' . $search . '%')
                                ->orWhere('username', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('project', fn ($nested) => $nested->where('title', 'like', '%' . $search . '%'));
                });
            })
            ->orderByDesc('last_message_at')
            ->orderByDesc('id')
            ->get();

        $unreadCounts = $this->fetchUnreadCounts($conversations->pluck('id'));

        return $conversations->map(function (Conversation $conversation) use ($unreadCounts) {
            $participant = $conversation->participants->firstWhere('user_id', $this->userId);

            $counterpart = $conversation->participants
                ->first(fn (ConversationParticipant $item) => $item->user_id !== $this->userId)
                ?? $conversation->participants->first();

            $user = optional($counterpart)->user;
            $name = $user?->fullname ?? $user?->username ?? __('messages.t_user');
            $preview = optional($conversation->lastMessage)->body
                ? Str::of(strip_tags($conversation->lastMessage->body))->squish()->limit(90)->toString()
                : __('messages.t_no_message_preview');

            return [
                'id' => $conversation->id,
                'uid' => $conversation->uid,
                'name' => $name,
                'initials' => $this->makeInitials($name),
                'avatar' => $user?->avatar ? src($user->avatar) : null,
                'online' => $user?->isOnline() ?? false,
                'preview' => $preview,
                'timestamp' => optional($conversation->last_message_at)->toIso8601String(),
                'time_label' => $conversation->last_message_at
                    ? $conversation->last_message_at->copy()->setTimezone(config('app.timezone'))->translatedFormat('h:i A')
                    : null,
                'unread' => $unreadCounts[$conversation->id] ?? 0,
                'participant_last_read_id' => $participant?->last_read_message_id,
                'participant_last_read_at' => optional($participant?->last_read_at)->toIso8601String(),
            ];
        })->all();
    }

    protected function fetchUnreadCounts(Collection $conversationIds): array
    {
        if ($conversationIds->isEmpty() || ! $this->userId) {
            return [];
        }

        if (! Schema::hasTable('conversation_participants')) {
            return [];
        }

        if (! Schema::hasTable('messages')) {
            return ConversationParticipant::query()
                ->whereIn('conversation_id', $conversationIds)
                ->where('user_id', $this->userId)
                ->pluck('unread_count', 'conversation_id')
                ->toArray();
        }

        $hasLastReadMessageId = Schema::hasColumn('conversation_participants', 'last_read_message_id');
        $hasLastReadAt = Schema::hasColumn('conversation_participants', 'last_read_at');

        if (! $hasLastReadMessageId && ! $hasLastReadAt) {
            return ConversationParticipant::query()
                ->whereIn('conversation_id', $conversationIds)
                ->where('user_id', $this->userId)
                ->pluck('unread_count', 'conversation_id')
                ->toArray();
        }

        return Message::query()
            ->select('messages.conversation_id', DB::raw('count(*) as total'))
            ->join('conversation_participants as cp', function ($join) {
                $join->on('cp.conversation_id', '=', 'messages.conversation_id')
                    ->where('cp.user_id', $this->userId);
            })
            ->whereIn('messages.conversation_id', $conversationIds)
            ->where('messages.user_id', '!=', $this->userId)
            ->where(function ($query) use ($hasLastReadMessageId, $hasLastReadAt) {
                if ($hasLastReadMessageId) {
                    $query->whereColumn('messages.id', '>', DB::raw('COALESCE(cp.last_read_message_id, 0)'))
                        ->orWhereNull('cp.last_read_message_id');
                }

                if ($hasLastReadAt) {
                    $query->orWhere(function ($subQuery) {
                        $subQuery->whereNull('cp.last_read_at')
                            ->orWhere(function ($nested) {
                                $nested->whereNotNull('messages.sent_at')
                                    ->whereColumn('messages.sent_at', '>', 'cp.last_read_at');
                            })
                            ->orWhere(function ($nested) {
                                $nested->whereNull('messages.sent_at')
                                    ->whereColumn('messages.created_at', '>', 'cp.last_read_at');
                            });
                    });
                }
            })
            ->groupBy('messages.conversation_id')
            ->pluck('total', 'conversation_id')
            ->toArray();
    }

    protected function setActiveConversation(int $conversationId, bool $preserveMessages = false): void
    {
        $this->activeConversationId = $conversationId;

        $this->loadConversationContext($conversationId);

        if ($preserveMessages) {
            $this->markConversationAsRead($this->latestMessageId);

            return;
        }

        $this->oldestMessageId = null;
        $this->latestMessageId = null;
        $this->messages = [];

        $this->loadMessages();
    }

    protected function loadConversationContext(int $conversationId): void
    {
        $conversation = Conversation::query()
            ->with([
                'participants.user:id,username,fullname,avatar_id',
                'project:id,title,slug',
            ])
            ->findOrFail($conversationId);

        abort_unless(
            $conversation->participants->contains(fn (ConversationParticipant $participant) => $participant->user_id === $this->userId),
            403
        );

        $participantStates = $conversation->participants->mapWithKeys(function (ConversationParticipant $participant) {
            $user = $participant->user;
            $name = $user?->fullname ?? $user?->username ?? __('messages.t_user');

            return [
                $participant->user_id => [
                    'id' => $participant->user_id,
                    'name' => $name,
                    'initials' => $this->makeInitials($name),
                    'avatar' => $user?->avatar ? src($user->avatar) : null,
                    'role' => $participant->role,
                    'last_read_message_id' => $participant->last_read_message_id,
                    'last_read_at' => optional($participant->last_read_at)->toIso8601String(),
                    'last_seen_at' => optional($participant->last_seen_at)->toIso8601String(),
                    'online' => $user?->isOnline() ?? false,
                ],
            ];
        })->toArray();

        $this->participantStates = $participantStates;
        $this->participants = array_values($participantStates);

        $counterpart = collect($participantStates)
            ->first(fn (array $participant, int $userId) => $userId !== $this->userId)
            ?? collect($participantStates)->first();

        $this->activeConversation = [
            'id' => $conversation->id,
            'uid' => $conversation->uid,
            'counterpart' => $counterpart,
            'project' => $conversation->project ? [
                'id' => $conversation->project->id,
                'title' => $conversation->project->title,
                'slug' => $conversation->project->slug,
            ] : null,
            'last_message_at' => optional($conversation->last_message_at)->toIso8601String(),
        ];
    }

    protected function loadMessages(bool $reset = true): void
    {
        if (! $this->activeConversationId) {
            $this->messages = [];
            $this->hasMoreMessages = false;
            $this->oldestMessageId = null;
            $this->latestMessageId = null;

            return;
        }

        if (! Schema::hasTable('messages')) {
            $this->messages = [];
            $this->hasMoreMessages = false;
            $this->oldestMessageId = null;
            $this->latestMessageId = null;

            return;
        }

        $query = Message::query()
            ->with(['sender:id,username,fullname,avatar_id', 'attachments'])
            ->where('conversation_id', $this->activeConversationId)
            ->orderByDesc('id')
            ->limit($this->messagesPerPage);

        if (! $reset && $this->oldestMessageId) {
            $query->where('id', '<', $this->oldestMessageId);
        }

        $messages = $query->get()->reverse()->values();
        $formatted = $messages->map(fn (Message $message) => $this->transformMessage($message))->all();

        if ($reset) {
            $this->messages = $formatted;
        } else {
            $this->messages = array_merge($formatted, $this->messages);
        }

        $this->messages = collect($this->messages)->sortBy('id')->values()->all();
        $this->oldestMessageId = $this->messages[0]['id'] ?? null;
        $this->latestMessageId = $this->messages ? $this->messages[array_key_last($this->messages)]['id'] : null;

        if ($this->oldestMessageId) {
            $this->hasMoreMessages = Message::query()
                ->where('conversation_id', $this->activeConversationId)
                ->where('id', '<', $this->oldestMessageId)
                ->exists();
        } else {
            $this->hasMoreMessages = false;
        }

        if ($reset) {
            $this->dispatch('chat:scroll-bottom');
        }

        if ($this->latestMessageId) {
            $this->markConversationAsRead($this->latestMessageId);
        }
    }

    protected function transformMessage(Message $message): array
    {
        $sender = $message->sender;
        $senderName = $sender?->fullname ?? $sender?->username ?? __('messages.t_user');
        $fromMe = $message->user_id === $this->userId;

        $messageTimestamp = $message->created_at ?? $message->sent_at;
        $messageMoment = $messageTimestamp ? Carbon::parse($messageTimestamp) : null;

        $readBy = collect($this->participantStates)
            ->filter(function (array $participant, int $userId) use ($message, $messageMoment) {
                if ($userId === $message->user_id) {
                    return false;
                }

                $lastId = $participant['last_read_message_id'] ?? null;

                if ($lastId && $lastId >= $message->id) {
                    return true;
                }

                if (! $messageMoment) {
                    return false;
                }

                $lastReadAtIso = $participant['last_read_at'] ?? null;

                if (! $lastReadAtIso) {
                    return false;
                }

                try {
                    $lastReadMoment = Carbon::parse($lastReadAtIso);
                } catch (\Throwable $exception) {
                    return false;
                }

                return $lastReadMoment->greaterThanOrEqualTo($messageMoment);
            })
            ->keys()
            ->map(fn ($userId) => (int) $userId)
            ->values()
            ->all();

        $participantState = $this->participantStates[$this->userId] ?? [];
        $lastReadId = $participantState['last_read_message_id'] ?? null;
        $isNew = ! $fromMe && ($lastReadId ? $message->id > $lastReadId : true);

        $state = null;

        if ($fromMe) {
            $state = ! empty($readBy)
                ? 'read'
                : ($message->delivered_at ? 'delivered' : 'sent');
        }

        $attachments = $message->attachments->map(function ($attachment) {
            return [
                'id' => $attachment->id,
                'name' => $attachment->original_name,
                'mime' => $attachment->mime,
                'size' => $attachment->size,
                'size_human' => format_bytes($attachment->size),
                'url' => $attachment->url,
            ];
        })->toArray();

        return [
            'conversation_id' => $message->conversation_id,
            'id' => $message->id,
            'type' => $message->type,
            'body' => $message->body,
            'body_plain' => trim(strip_tags($message->body ?? '')),
            'from_me' => $fromMe,
            'sender' => [
                'id' => $sender?->id,
                'name' => $senderName,
                'initials' => $this->makeInitials($senderName),
                'avatar' => $sender?->avatar ? src($sender->avatar) : null,
            ],
            'time' => optional($message->created_at)->toIso8601String(),
            'time_human' => $this->formatMessageTime(optional($message->created_at)->toIso8601String()),
            'state' => $state,
            'delivered_at' => optional($message->delivered_at)->toIso8601String(),
            'read_by' => $readBy,
            'attachments' => $attachments,
            'meta' => $message->meta ?? [],
            'is_new' => $isNew,
        ];
    }

    protected function markConversationAsRead(?int $latestMessageId): void
    {
        if (! $this->activeConversationId || ! $this->userId) {
            return;
        }

        if (! Schema::hasTable('conversation_participants')) {
            return;
        }

        $now = now();
        $hasMessagesTable = Schema::hasTable('messages');
        $hasLastReadMessageId = Schema::hasColumn('conversation_participants', 'last_read_message_id');

        $latestUnread = null;

        if ($hasMessagesTable && $latestMessageId) {
            $latestUnread = Message::query()
                ->where('conversation_id', $this->activeConversationId)
                ->where('user_id', '!=', $this->userId)
                ->where('id', '<=', $latestMessageId)
                ->orderByDesc('id')
                ->first();
        }

        $participant = ConversationParticipant::query()
            ->where('conversation_id', $this->activeConversationId)
            ->where('user_id', $this->userId)
            ->first();

        if (! $participant) {
            return;
        }

        $updates = [
            'last_seen_at' => $now,
            'last_read_at' => $now,
            'unread_count' => 0,
        ];

        $messageIdForEvent = $latestUnread?->id ?? $latestMessageId ?? null;

        if ($hasLastReadMessageId) {
            $updates['last_read_message_id'] = $latestUnread?->id ?? $latestMessageId ?? $participant->last_read_message_id;
        }

        $participant->forceFill($updates)->save();

        if ($messageIdForEvent) {
            event(new MessageRead(
                $this->activeConversationId,
                $messageIdForEvent,
                $this->userId,
                $now->toIso8601String()
            ));
        }

        if ($hasLastReadMessageId) {
            $this->participantStates[$this->userId]['last_read_message_id'] = $updates['last_read_message_id'] ?? null;
        }

        $this->participantStates[$this->userId]['last_seen_at'] = $now->toIso8601String();
        $this->participantStates[$this->userId]['last_read_at'] = $now->toIso8601String();

        $this->updateActiveConversationUnread(0);
    }

    protected function updateActiveConversationUnread(int $value): void
    {
        foreach ($this->conversations as &$conversation) {
            if ($conversation['id'] !== $this->activeConversationId) {
                continue;
            }

            $conversation['unread'] = $value;
        }

        unset($conversation);

        $this->dispatchUnreadCount();
    }

    protected function dispatchUnreadCount(): void
    {
        $totalUnread = collect($this->conversations)->sum(
            fn ($conversation) => (int) ($conversation['unread'] ?? 0)
        );

        $this->dispatch('messages:unread-count', count: $totalUnread);
    }

    protected function resetComposer(): void
    {
        if ($this->composerTyping) {
            $this->broadcastTypingStopped();
        }

        $this->messageBody = '';
        $this->uploadQueue = [];
        $this->composerTyping = false;
        $this->lastTypingBroadcastAt = null;
    }

    protected function broadcastTypingStarted(): void
    {
        if (! $this->activeConversationId || ! $this->userId) {
            return;
        }

        event(new TypingStarted($this->activeConversationId, $this->userId));
    }

    protected function broadcastTypingStopped(): void
    {
        if (! $this->activeConversationId || ! $this->userId || ! $this->composerTyping) {
            return;
        }

        event(new TypingStopped($this->activeConversationId, $this->userId));
        $this->composerTyping = false;
        $this->lastTypingBroadcastAt = null;
    }

    protected function normalizeBroadcastMessage(array $payload): array
    {
        $message = $payload['message'] ?? [];
        $sender = $payload['sender'] ?? [];
        $fromMe = (int) ($message['user_id'] ?? 0) === $this->userId;
        $senderName = $sender['name'] ?? ($this->participantStates[$sender['id'] ?? 0]['name'] ?? __('messages.t_user'));

        $attachments = collect($message['attachments'] ?? [])->map(fn ($attachment) => [
            'id' => $attachment['id'] ?? null,
            'name' => $attachment['original_name'] ?? $attachment['name'] ?? __('messages.t_attachment'),
            'mime' => $attachment['mime'] ?? null,
            'size' => $attachment['size'] ?? null,
            'size_human' => isset($attachment['size']) ? format_bytes($attachment['size']) : null,
            'url' => $attachment['url'] ?? null,
        ])->all();

        return [
            'id' => (int) ($message['id'] ?? 0),
            'type' => $message['type'] ?? 'text',
            'body' => $message['body'] ?? null,
            'body_plain' => trim(strip_tags($message['body'] ?? '')),
            'from_me' => $fromMe,
            'sender' => [
                'id' => $sender['id'] ?? ($message['user_id'] ?? null),
                'name' => $senderName,
                'initials' => $this->makeInitials($senderName),
                'avatar' => $sender['avatar'] ?? null,
            ],
            'time' => $message['created_at'] ?? $message['sent_at'] ?? null,
            'time_human' => $this->formatMessageTime($message['created_at'] ?? $message['sent_at'] ?? null),
            'state' => $fromMe
                ? (($message['delivered_at'] ?? null) ? 'delivered' : 'sent')
                : null,
            'delivered_at' => $message['delivered_at'] ?? null,
            'read_by' => [],
            'attachments' => $attachments,
            'meta' => $message['meta'] ?? [],
            'conversation_id' => (int) ($payload['conversation_id'] ?? 0),
            'is_new' => ! $fromMe,
        ];
    }

    protected function updateConversationPreviewFromBroadcast(array $message): void
    {
        $conversationId = $message['conversation_id'] ?? null;

        if (! $conversationId) {
            $conversationId = $this->activeConversationId;
        }

        if (! $conversationId) {
            return;
        }

        if (! collect($this->conversations)->pluck('id')->contains($conversationId)) {
            $this->hydrateState(keepMessages: true);

            return;
        }

        foreach ($this->conversations as $index => $conversation) {
            if ($conversation['id'] !== $conversationId) {
                continue;
            }

            $conversation['preview'] = $message['body_plain'] ?: __('messages.t_no_message_preview');
            $conversation['timestamp'] = $message['time'];
            $conversation['time_label'] = $this->formatMessageTime($message['time']);
            $conversation['unread'] = $message['from_me'] || $conversationId === $this->activeConversationId
                ? 0
                : ($conversation['unread'] ?? 0) + 1;

            $this->conversations[$index] = $conversation;
        }

        $this->conversations = collect($this->conversations)
            ->sortByDesc(fn ($conversation) => $conversation['timestamp'] ?? null)
            ->values()
            ->all();

        $this->dispatchUnreadCount();
    }

    protected function makeInitials(?string $name): string
    {
        if (! $name) {
            return '؟';
        }

        $parts = Str::of($name)->squish()->explode(' ');

        return $parts->map(fn ($part) => Str::upper(Str::substr($part, 0, 1)))
            ->take(2)
            ->implode('');
    }

    protected function formatMessageTime(?string $timestamp): ?string
    {
        if (! $timestamp) {
            return null;
        }

        return Carbon::parse($timestamp)
            ->setTimezone(config('app.timezone'))
            ->translatedFormat('h:i A');
    }
}
