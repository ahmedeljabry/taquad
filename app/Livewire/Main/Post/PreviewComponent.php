<?php

namespace App\Livewire\Main\Post;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Models\ProjectCategory;

class PreviewComponent extends Component
{
    use SEOToolsTrait;

    public array $project = [];
    public ?ProjectCategory $category = null;
    public array $skills = [];
    public array $plans = [];

    public function mount(string $token)
    {
        if (!auth()->check()) {
            session()->flash('preview_error', 'يجب تسجيل الدخول لمعاينة المشروع.');
            return redirect('post/project');
        }

        $payload = session()->pull($this->sessionKey($token));

        if (!$payload) {
            session()->flash('preview_error', 'انتهت صلاحية رابط المعاينة، يرجى المحاولة من جديد.');
            return redirect('post/project');
        }

        $this->project = $payload;
        $this->category = isset($payload['category_id'])
            ? ProjectCategory::select('id', 'name', 'slug')->find($payload['category_id'])
            : null;
        $this->skills = $payload['skills'] ?? [];
        $this->plans = $payload['plans'] ?? [];

        $title = $payload['title'] ?: __('messages.t_project_preview', [], app()->getLocale());
        if ($title === 'messages.t_project_preview') {
            $title = 'معاينة مشروع';
        }
        $description = $payload['description_preview'] ?? $payload['description'] ?? 'راجع تفاصيل المشروع وتأكد من وضوح الأهداف قبل النشر.';

        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $this->seo()->setCanonical(url()->current());
    }

    protected function sessionKey(string $token): string
    {
        $userId = auth()->id() ?? 'guest';

        return "project-preview:{$userId}:{$token}";
    }

    #[Layout('components.layouts.main-app')]
    public function render()
    {
        return view('livewire.main.post.preview', [
            'category' => $this->category,
        ]);
    }
}
