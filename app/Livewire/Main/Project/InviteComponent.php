<?php

namespace App\Livewire\Main\Project;

use App\Http\Validators\Main\Profile\OfferValidator;
use App\Models\Admin;
use App\Models\CustomOffer;
use App\Models\CustomOfferAttachment;
use App\Models\User;
use App\Notifications\Admin\NewCustomOfferPending;
use App\Notifications\User\Freelancer\NewOfferReceived;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class InviteComponent extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    use SEOToolsTrait;

    public User $freelancer;

    public string $message = '';
    public string $budget = '';
    public ?int $expected_duration = null;
    public array $attachments = [];

    protected $listeners = [
        'attachmentsUpdated' => 'updatedAttachments',
    ];

    public function mount(string $username): mixed
    {
        if (!auth()->check()) {
            return Redirect::guest(route('login'));
        }

        $settings = settings('publish');
        if (!$settings->enable_custom_offers) {
            abort(404);
        }

        $freelancer = User::query()
            ->where('username', $username)
            ->where('account_type', 'seller')
            ->whereIn('status', ['active', 'verified'])
            ->firstOrFail();

        if ($freelancer->id === auth()->id()) {
            abort(403);
        }

        $this->freelancer = $freelancer;
        $this->expected_duration = $settings->custom_offers_default_delivery_days ?? 7;

        $this->message = '';
        $this->budget = '';

        return null;
    }

    public function updatedAttachments($value): void
    {
        $this->attachments = $value;
    }

    public function removeAttachment(string $uid): void
    {
        $this->attachments = collect($this->attachments)
            ->reject(fn ($file) => data_get($file, 'temporaryUuid') === $uid)
            ->values()
            ->all();
    }

    public function invite(): void
    {
        $settings = settings('publish');

        OfferValidator::validate($this);

        if ($this->freelancer->availability) {
            $this->alert('error', __('messages.t_error'), [
                'text'     => __('messages.t_this_user_is_not_available_right_now_msg', [
                    'date' => $this->freelancer->availability->expected_available_date,
                ]),
                'toast'    => true,
                'position' => 'top-end',
            ]);

            return;
        }

        $budgetAmount = convertToNumber($this->budget);

        $budgetFreelancerFee = 0;
        if ($settings->custom_offers_commission_value_freelancer > 0) {
            $budgetFreelancerFee = $settings->custom_offers_commission_type === 'percentage'
                ? ($settings->custom_offers_commission_value_freelancer / 100) * $budgetAmount
                : $settings->custom_offers_commission_value_freelancer;
        }

        $budgetBuyerFee = 0;
        if ($settings->custom_offers_commission_value_buyer > 0) {
            $budgetBuyerFee = $settings->custom_offers_commission_type === 'percentage'
                ? ($settings->custom_offers_commission_value_buyer / 100) * $budgetAmount
                : $settings->custom_offers_commission_value_buyer;
        }

        $offer = new CustomOffer();
        $offer->uid                   = uid();
        $offer->freelancer_id         = $this->freelancer->id;
        $offer->buyer_id              = auth()->id();
        $offer->message               = clean($this->message);
        $offer->budget_amount         = $budgetAmount;
        $offer->budget_buyer_fee      = $budgetBuyerFee;
        $offer->budget_freelancer_fee = $budgetFreelancerFee;
        $offer->delivery_time         = $this->expected_duration;
        $offer->freelancer_status     = 'pending';
        $offer->admin_status          = $settings->custom_offers_require_approval ? 'pending' : 'approved';
        $offer->expires_at            = now()->addDays($settings->custom_offers_expiry_days);
        $offer->save();

        if (!empty($this->attachments)) {
            foreach ($this->attachments as $file) {
                if (!method_exists($file, 'storeAs')) {
                    continue;
                }

                $attachmentUid = (string) Str::uuid();
                $originalTitle = substr(htmlentities(trim(clean($file->getClientOriginalName())), ENT_QUOTES, 'UTF-8'), 0, 300);
                $newTitle      = $attachmentUid . '.' . $file->extension();

                $file->storeAs('offers-attachments', $newTitle, 'custom');

                $attachment                     = new CustomOfferAttachment();
                $attachment->offer_id           = $offer->id;
                $attachment->uid                = $attachmentUid;
                $attachment->file_original_name = $originalTitle;
                $attachment->file_size          = $file->getSize();
                $attachment->file_extension     = $file->extension();
                $attachment->file_mime          = $file->getMimeType();
                $attachment->save();
            }
        }

        if ($settings->custom_offers_require_approval) {
            Admin::first()?->notify(new NewCustomOfferPending($offer));

            $successMessage = __('messages.t_ur_custom_offer_has_been_sent_pending_admin_approval');
        } else {
            notification([
                'text'    => 't_a_new_custom_offer_received',
                'action'  => url('seller/offers'),
                'user_id' => $this->freelancer->id,
            ]);

            $this->freelancer->notify(new NewOfferReceived($offer));

            $successMessage = __('messages.t_ur_custom_offer_has_been_sent_to_freelancer');
        }

        $this->reset(['message', 'budget', 'expected_duration', 'attachments']);

        $this->alert('success', __('messages.t_success'), [
            'text'     => $successMessage,
            'toast'    => true,
            'position' => 'top-end',
        ]);

        $this->redirect(route('invite.freelancer', ['username' => $this->freelancer->username]), navigate: true);
    }

    #[Layout('components.layouts.main-app')]
    public function render()
    {
        $separator   = settings('general')->separator;
        $title       = __('messages.t_invite_freelancer_title', ['name' => $this->freelancer->fullname ?: $this->freelancer->username]) . " $separator " . settings('general')->title;
        $description = __('messages.t_invite_freelancer_description');
        $ogimage     = src(settings('seo')->ogimage);

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

        return view('livewire.main.project.invite', [
            'settings'   => settings('publish'),
            'freelancer' => $this->freelancer,
        ]);
    }
}
