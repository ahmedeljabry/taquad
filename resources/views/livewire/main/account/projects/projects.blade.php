@php
    $projectCollection = $projects instanceof \Illuminate\Pagination\LengthAwarePaginator ? $projects->getCollection() : collect($projects);
    $activeCount = $projectCollection->where('status', 'active')->count();
    $reviewCount = $projectCollection->whereIn('status', ['pending_approval', 'pending_payment'])->count();
    $completedCount = $projectCollection->where('status', 'completed')->count();
    $draftCount = $projectCollection->whereIn('status', ['hidden', 'rejected'])->count();
@endphp

<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24 space-y-12">
    <div class="lg:grid lg:grid-cols-12">
        <aside
            class="lg:col-span-3 py-6 hidden lg:block bg-white shadow-sm border border-gray-200 rounded-lg dark:bg-zinc-800 dark:border-transparent"
            wire:ignore>
            <x-main.account.sidebar />
        </aside>
<div class="lg:col-span-9 lg:ltr:ml-8 lg:rtl:mr-8">
        <section
            class="relative overflow-hidden rounded-3xl border border-white/50 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 px-6 py-10 text-white shadow-xl dark:border-slate-700">
            <div class="absolute inset-0 opacity-20"
                style="background-image: radial-gradient(circle at 10% 20%, rgba(255,255,255,0.6) 0%, transparent 30%), radial-gradient(circle at 90% 10%, rgba(255,255,255,0.4) 0%, transparent 35%);">
            </div>
            <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-4">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1 text-[12px] font-semibold uppercase tracking-[0.3em]">
                        <i class="ph ph-squares-four"></i>
                        @lang('messages.t_my_projects')
                    </span>
                    <div>
                        <h1 class="text-3xl font-bold sm:text-4xl">خطط، راقب، ووجّه فريقك بثقة.</h1>
                        <p class="mt-3 max-w-2xl text-sm text-white/70">
                            لوحة متابعة مشاريعك تمنحك رؤية لحظية لحالة كل طلب، دفعاته، واستجابات المستقلين حتى تتخذ
                            القرار
                            بسرعة.
                        </p>
                    </div>
                    <div
                        class="flex flex-wrap gap-3 text-[12px] font-semibold uppercase tracking-[0.2em] text-white/70">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1">
                            <i class="ph ph-queue"></i>
                            {{ $projects->total() }} @lang('messages.t_projects')
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1">
                            <i class="ph ph-user-circle"></i>
                            {{ auth()->user()->fullname ?? auth()->user()->username }}
                        </span>
                    </div>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="{{ url('post/project') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-md transition hover:-translate-y-0.5 hover:bg-white/90">
                        <i class="ph ph-plus-circle"></i>
                        مشروع جديد
                    </a>
                    <a href="{{ url('explore/projects') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-white/30 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
                        <i class="ph ph-compass"></i>
                        استعرض المستقلين
                    </a>
                </div>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div
                class="rounded-2xl border border-white/60 bg-white/95 p-5 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">
                            مشاريع نشطة</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">{{ $activeCount }}</p>
                    </div>
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-full bg-primary-500/10 text-primary-600 dark:text-primary-400">
                        <i class="ph ph-lightning text-xl"></i>
                    </span>
                </div>
                <p class="mt-3 text-[12px] text-slate-500 dark:text-slate-400">طلبات قيد التنفيذ أو بانتظار تسليم دفعات
                    جديدة.</p>
            </div>
            <div
                class="rounded-2xl border border-white/60 bg-white/95 p-5 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">
                            قيد
                            المراجعة</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">{{ $reviewCount }}</p>
                    </div>
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400">
                        <i class="ph ph-hourglass text-xl"></i>
                    </span>
                </div>
                <p class="mt-3 text-[12px] text-slate-500 dark:text-slate-400">طلبات تنتظر تمويل الدفعه الأول أو موافقة
                    الإدارة.</p>
            </div>
            <div
                class="rounded-2xl border border-white/60 bg-white/95 p-5 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">
                            مُكتملة</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">{{ $completedCount }}</p>
                    </div>
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                        <i class="ph ph-check-circle text-xl"></i>
                    </span>
                </div>
                <p class="mt-3 text-[12px] text-slate-500 dark:text-slate-400">مشاريع أُنجزت وتم تحرير دفعاتها النهائية.
                </p>
            </div>
            <div
                class="rounded-2xl border border-white/60 bg-white/95 p-5 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">
                            في
                            الأرشيف</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">{{ $draftCount }}</p>
                    </div>
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-200 text-slate-600 dark:bg-slate-700/60 dark:text-slate-300">
                        <i class="ph ph-archive-box text-xl"></i>
                    </span>
                </div>
                <p class="mt-3 text-[12px] text-slate-500 dark:text-slate-400">طلبات مخفية أو مرفوضة يمكن تعديلها وإعادة
                    نشرها لاحقاً.</p>
            </div>
        </section>

        <div
            class="rounded-3xl border border-white/60 bg-white/95 p-6 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">قائمة المشاريع</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">راجع حالة كل مشروع، التمويل، وعدد العروض
                        المستلمة.
                    </p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ url('post/project') }}"
                        class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-primary-700">
                        <i class="ph ph-plus"></i>
                        مشروع جديد
                    </a>
                    <a href="{{ url('explore/projects') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:text-zinc-300">
                        <i class="ph ph-rocket-launch"></i>
                        ابحث عن مستقل
                    </a>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200 dark:border-zinc-700">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-zinc-700">
                    <thead
                        class="bg-slate-50 text-[12px] font-semibold uppercase tracking-[0.2em] text-slate-500 dark:bg-zinc-800 dark:text-zinc-300">
                        <tr>
                            <th class="px-5 py-3 text-right">@lang('messages.t_project')</th>
                            <th class="px-5 py-3 text-center">@lang('messages.t_status')</th>
                            <th class="px-5 py-3 text-center">@lang('messages.t_bids')</th>
                            <th class="px-5 py-3 text-center">@lang('messages.t_budget')</th>
                            <th class="px-5 py-3 text-center">@lang('messages.t_actions')</th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-slate-100 bg-white text-slate-700 dark:divide-zinc-800 dark:bg-zinc-900 dark:text-zinc-200">
                        @forelse ($projects as $project)
                            <tr class="hover:bg-primary-50/40 dark:hover:bg-primary-500/5">
                                <td class="max-w-xs px-5 py-4 align-top">
                                    <div class="flex flex-col gap-1">
                                        <a href="{{ url('project/' . $project->pid . '/' . $project->slug) }}"
                                            class="font-semibold text-slate-900 transition hover:text-primary-600 dark:text-white">{{ $project->title }}</a>
                                        <span
                                            class="text-[12px] text-slate-500 dark:text-slate-400">{{ format_date($project->created_at, config('carbon-formats.F_d,_Y')) }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-center align-top">
                                    @php
                                        $statusColorMap = [
                                            'pending_payment'     => 'bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-300',
                                            'pending_approval'    => 'bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-300',
                                            'active'              => 'bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:text-blue-300',
                                            'under_development'   => 'bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:text-blue-300',
                                            'pending_final_review'=> 'bg-indigo-100 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300',
                                            'completed'           => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300',
                                            'incomplete'          => 'bg-rose-100 text-rose-700 dark:bg-rose-500/10 dark:text-rose-300',
                                            'closed'              => 'bg-slate-200 text-slate-700 dark:bg-slate-700/30 dark:text-slate-300',
                                            'hidden'              => 'bg-slate-200 text-slate-700 dark:bg-slate-700/30 dark:text-slate-300',
                                            'rejected'            => 'bg-rose-100 text-rose-700 dark:bg-rose-500/10 dark:text-rose-300',
                                        ];
                                        $statusClass = $statusColorMap[$project->status] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-700/30 dark:text-slate-300';
                                        $isHourly = $project->budget_type === 'hourly';
                                        $primaryActionLabel = $isHourly ? __('messages.t_manage_tracked_hours') : __('messages.t_manage_milestones');
                                        $primaryActionUrl = $isHourly
                                            ? url('account/projects/options/tracker/' . $project->uid)
                                            : url('account/projects/options/milestones/' . $project->uid);
                                        $conversationUrl = url('chat');
                                    @endphp
                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-semibold {{ $statusClass }}">
                                        {{ __('messages.t_' . $project->status) }}
                                    </span>
                                    @if ($isHourly)
                                        <p class="mt-2 text-[11px] text-slate-500 dark:text-slate-400">
                                            @lang('messages.t_hourly_project_short_hint')
                                        </p>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center align-top">
                                    <span
                                        class="font-semibold text-slate-900 dark:text-white">{{ number_format($project->bids_count ?? 0) }}</span>
                                </td>
                                <td class="px-5 py-4 text-center align-top">
                                    <span class="text-sm font-semibold text-slate-900 dark:text-white">
                                        {{ money($project->budget_min, settings('currency')->code, true) }} -
                                        {{ money($project->budget_max, settings('currency')->code, true) }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-center align-top">
                                    <div class="flex flex-col items-center justify-center gap-2 sm:flex-row">
                                        <a href="{{ url('project/' . $project->pid . '/' . $project->slug) }}"
                                            class="inline-flex items-center gap-1 rounded-full border border-slate-200 px-3 py-1 text-[12px] font-semibold text-slate-600 transition hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:text-zinc-300">
                                            <i class="ph ph-eye"></i>
                                            @lang('messages.t_view')
                                        </a>
                                        <a href="{{ $primaryActionUrl }}"
                                            class="inline-flex items-center gap-1 rounded-full border border-primary-500 px-3 py-1 text-[12px] font-semibold text-primary-600 transition hover:bg-primary-50 dark:border-primary-400 dark:text-primary-200 dark:hover:bg-primary-500/10">
                                            <i class="ph ph-gear-six"></i>
                                            {{ $primaryActionLabel }}
                                        </a>
                                        <a href="{{ $conversationUrl }}"
                                            class="inline-flex items-center gap-1 rounded-full border border-slate-200 px-3 py-1 text-[12px] font-semibold text-slate-600 transition hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:text-zinc-300">
                                            <i class="ph ph-chat-circle-dots"></i>
                                            @lang('messages.t_contact_freelancer')
                                        </a>
                                        <a href="{{ url('post/project') . '?clone=' . $project->uid }}"
                                            class="inline-flex items-center gap-1 rounded-full border border-slate-200 px-3 py-1 text-[12px] font-semibold text-slate-600 transition hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:text-zinc-300">
                                            <i class="ph ph-copy"></i>
                                            @lang('messages.t_duplicate')
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-10 text-center">
                                    <div class="space-y-3 text-sm text-slate-500 dark:text-slate-400">
                                        <p>لم تنشئ أي مشاريع بعد. ابدأ الآن واستقبل عروض المستقلين خلال دقائق.</p>
                                        <a href="{{ url('post/project') }}"
                                            class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-primary-700">
                                            <i class="ph ph-plus"></i>
                                            نشر أول مشروع
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-center">
                {{ $projects->links('pagination::tailwind') }}
            </div>
        </div>
</div>

    </div>


</div>
