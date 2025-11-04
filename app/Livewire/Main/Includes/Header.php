<?php

namespace App\Livewire\Main\Includes;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Language;
use WireUi\Traits\Actions;
use App\Models\Notification;
use Conner\Tagging\Model\Tag;
use App\Models\ConversationParticipant;
use Illuminate\Support\Facades\Cookie;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Collection;

class Header extends Component
{
    use Actions, LivewireAlert;

    public $new_messages;
    public Collection $notifications;

    public $q;

    public $sellers = [];
    public $tags    = [];

    public $default_language_name;
    public $default_language_code;
    public $default_country_code;

    /**
     * Init component
     *
     * @return void
     */
    public function mount()
    {
        // Clean query
        $this->q = clean($this->q);

        // Check if user online
        if (auth()->check()) {

            // Count unread messages
            $this->new_messages = ConversationParticipant::where('user_id', auth()->id())
                ->sum('unread_count');

            // Get notifications
            $this->notifications = $this->unreadNotifications();
        } else {
            $this->notifications = collect();
        }

        // Get language from session
        $locale   = session()->has('locale') ? session()->get('locale') : settings('general')->default_language;

        // Get default language
        $language = Language::where('language_code', $locale)->first();

        // Check if language exists
        if ($language) {

            // Set default language
            $this->default_language_name = $language->name;
            $this->default_language_code = $language->language_code;
            $this->default_country_code  = $language->country_code;
        } else {

            // Not found, set default
            $this->default_language_name = "English";
            $this->default_language_code = "en";
            $this->default_country_code  = "us";
        }
    }

    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.main.includes.header', [
            'languages'  => $this->languages,
        ]);
    }


    /**
     * Listen when q keyword changes
     *
     * @return void
     */
    public function updatedQ()
    {
        // Search
        $this->search();
    }


    /**
     * Search by query
     *
     * @return mixed
     */
    public function search()
    {

        // Check if has a searching keyword
        if ($this->q) {

            // Set keyword
            $keyword       = $this->q;

            // Get sellers
            $sellers       = User::query()
                ->whereIn('status', ['verified', 'active'])
                ->where('account_type', 'seller')
                ->where(function ($query) use ($keyword) {
                    return $query->where('username', 'LIKE', "%{$keyword}%")
                        ->orWhere('fullname', 'LIKE', "%{$keyword}%")
                        ->orWhere('headline', 'LIKE', "%{$keyword}%")
                        ->orWhere('description', 'LIKE', "%{$keyword}%");
                })
                ->select('id', 'username', 'avatar_id', 'status', 'headline', 'fullname', 'description', 'account_type')
                ->with('avatar')
                ->limit(10)
                ->get();

            // Set sellers
            $this->sellers = $sellers;

            // Get tags
            $tags          = Tag::query()
                ->where('name', 'LIKE', "%{$keyword}%")
                ->select('slug', 'name')
                ->limit(10)
                ->get();

            // Set tags
            $this->tags    = $tags;
        } else {

            // Reset data
            $this->reset(['q', 'sellers', 'tags']);
        }
    }


    /**
     * Go to search page
     *
     * @return void
     */
    public function enter()
    {
        // Check if has a search term
        if (!$this->q) {

            // Error
            $this->notification([
                'title'       => __('messages.t_info'),
                'description' => __('messages.t_pls_type_a_search_term_first'),
                'icon'        => 'info'
            ]);

            return;
        }

        // Redirect to search page
        return redirect('search?q=' . $this->q);
    }


    /**
     * Get supported languages
     *
     * @return object
     */
    public function getLanguagesProperty()
    {
        return Language::orderBy('name', 'asc')->get();
    }


    /**
     * Mark notification as read
     *
     * @param string $id
     * @return void
     */
    #[On('notifications:refresh')]
    public function refreshNotifications(...$arguments): void
    {
        if (! auth()->check()) {
            $this->notifications = collect();
            return;
        }

        [$eventName, $payload] = $this->parseEventArguments($arguments);

        if (in_array($eventName, ['notification.created', 'notification.sent'], true) && isset($payload['id'])) {
            $notification = Notification::where('uid', $payload['id'])
                ->where('user_id', auth()->id())
                ->latest('id')
                ->first();

            if ($notification && ! $notification->is_seen) {
                $existing = $this->notifications ?? collect();
                $this->notifications = collect([$notification])
                    ->merge($existing)
                    ->unique('uid')
                    ->sortByDesc('created_at')
                    ->values();

                return;
            }
        }

        $this->notifications = $this->unreadNotifications();
    }


    /**
     * Close announce
     *
     * @return void
     */
    public function closeAnnounce()
    {
        // Set cookie
        Cookie::queue('header_announce_closed', true, 4320);
    }


    /**
     * Change locale
     *
     * @param string $locale
     * @return void
     */
    public function setLocale($locale)
    {
        // Get language
        $language = Language::where('language_code', $locale)->where('is_active', true)->first();

        // Check if language exists
        if (!$language) {

            // Not found
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_selected_lang_does_not_found'),
                'icon'        => 'error'
            ]);

            return;
        }

        // Set default language
        session()->put('locale', $language->language_code);

        // Refresh the page
        $this->dispatch('refresh');
    }

    /**
     * Fetch unread notifications.
     */
    protected function unreadNotifications(): Collection
    {
        if (! auth()->check()) {
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

        $eventCandidate   = $arguments[0] ?? null;
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
