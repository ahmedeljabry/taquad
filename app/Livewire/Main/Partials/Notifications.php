<?php

namespace App\Livewire\Main\Partials;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Notification;
use Illuminate\Support\Collection;

class Notifications extends Component
{
    /**
     * Cached unread notifications.
     */
    public Collection $notifications;

    /**
     * Recently delivered notification id used for highlighting.
     */
    public ?string $highlightedNotification = null;

    /**
     * Init component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->notifications = $this->unreadNotifications();
    }

    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.main-app')]
    public function render()
    {
        return view('livewire.main.partials.notifications');
    }


    /**
     * Mark notification as read
     *
     * @param string $id
     * @return void
     */
    public function read(string $id): void
    {
        Notification::where('uid', $id)->where('user_id', auth()->id())->update([
            'is_seen' => true
        ]);

        $this->highlightedNotification = null;
        $this->notifications           = $this->unreadNotifications();

        $this->dispatch('notifications:refresh', [
            'event'   => 'notification.read',
            'payload' => ['id' => $id],
        ]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): void
    {
        Notification::where('user_id', auth()->id())
            ->where('is_seen', false)
            ->update(['is_seen' => true]);

        $this->highlightedNotification = null;
        $this->notifications           = collect();

        $this->dispatch('notifications:refresh', [
            'event'   => 'notification.markAll',
            'payload' => null,
        ]);
    }

    /**
     * Manual refresh.
     */
    public function refreshList(): void
    {
        $this->highlightedNotification = null;
        $this->notifications           = $this->unreadNotifications();
    }

    #[On('notifications:refresh')]
    public function refreshNotifications(...$arguments): void
    {
        if (!auth()->check()) {
            $this->notifications           = collect();
            $this->highlightedNotification = null;

            return;
        }

        [$eventName, $payload] = $this->parseEventArguments($arguments);

        if (in_array($eventName, ['notification.created', 'notification.sent'], true) && isset($payload['id'])) {
            $notification = Notification::where('uid', $payload['id'])
                ->where('user_id', auth()->id())
                ->latest('id')
                ->first();

            if ($notification && !$notification->is_seen) {
                $existing = $this->notifications ?? collect();
                $this->notifications = collect([$notification])
                    ->merge($existing)
                    ->unique('uid')
                    ->sortByDesc('created_at')
                    ->values();

                $this->highlightedNotification = $notification->uid;

                return;
            }
        }

        $this->highlightedNotification = null;
        $this->notifications           = $this->unreadNotifications();
    }

    /**
     * Fetch unread notifications.
     */
    protected function unreadNotifications(): Collection
    {
        if (!auth()->check()) {
            return collect();
        }

        return Notification::where('user_id', auth()->id())
            ->where('is_seen', false)
            ->latest()
            ->take(30)
            ->get();
    }

    /**
     * Normalize Livewire event arguments.
     *
     * @param array<int, mixed> $arguments
     * @return array{0: string|null, 1: array}
     */
    protected function parseEventArguments(array $arguments): array
    {
        $eventName = null;
        $payload   = [];

        if (count($arguments) === 0) {
            return [$eventName, $payload];
        }

        if (count($arguments) === 1) {
            $value = $arguments[0];

            if (is_array($value)) {
                $eventName = $value['event'] ?? $value[0] ?? null;
                $payload   = $value['payload'] ?? (isset($value['id']) ? $value : []);

                return [$eventName, is_array($payload) ? $payload : []];
            }

            if (is_string($value)) {
                return [$value, []];
            }

            if (is_object($value)) {
                $array     = (array) $value;
                $eventName = $array['event'] ?? null;
                $payload   = $array['payload'] ?? [];

                return [$eventName, is_array($payload) ? $payload : []];
            }
        }

        $eventCandidate = $arguments[0] ?? null;
        $payloadCandidate = $arguments[1] ?? [];

        if (is_string($eventCandidate)) {
            $eventName = $eventCandidate;
        }

        if (is_array($payloadCandidate)) {
            $payload = $payloadCandidate;
        } elseif (is_object($payloadCandidate)) {
            $payload = (array) $payloadCandidate;
        }

        return [$eventName, $payload];
    }
}
