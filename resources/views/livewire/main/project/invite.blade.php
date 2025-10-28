<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-16">
    <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_360px]">
        <div class="space-y-8">
            <div class="space-y-3">
                <span class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-200">
                    <i class="ph-duotone ph-sparkle text-sm"></i>
                    {{ __('messages.t_invite_freelancer_tagline') }}
                </span>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                    {{ __('messages.t_invite_freelancer_heading', ['name' => $freelancer->fullname ?: $freelancer->username]) }}
                </h1>
                <p class="text-base text-slate-600 dark:text-zinc-300 max-w-2xl">
                    {{ __('messages.t_invite_freelancer_intro') }}
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 shadow-xl shadow-primary-500/5 bg-white dark:border-white/10 dark:bg-white/5">
                <form wire:submit.prevent="invite" class="space-y-10 p-8 lg:p-12">
                    <div class="grid gap-8 lg:grid-cols-2">
                        <div class="lg:col-span-2 space-y-3">
                            <label for="message" class="text-sm font-semibold text-slate-700 dark:text-zinc-200">
                                {{ __('messages.t_invite_freelancer_brief') }}
                            </label>
                            <textarea
                                id="message"
                                rows="6"
                                wire:model.defer="message"
                                class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-900 shadow-inner focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-white/10 dark:bg-white/5 dark:text-zinc-100 dark:focus:ring-primary-500/50"
                                placeholder="{{ __('messages.t_invite_freelancer_placeholder') }}"></textarea>
                            @error('message')
                                <p class="text-sm font-semibold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-3">
                            <label for="budget" class="text-sm font-semibold text-slate-700 dark:text-zinc-200">
                                {{ __('messages.t_invite_freelancer_budget') }}
                            </label>
                            <div class="relative">
                                <input
                                    id="budget"
                                    type="number"
                                    step="0.01"
                                    wire:model.defer="budget"
                                    class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-inner focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-white/10 dark:bg-white/5 dark:text-zinc-100 dark:focus:ring-primary-500/50"
                                    placeholder="0.00">
                                <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-xs font-semibold uppercase tracking-[0.2em] text-slate-400 dark:text-zinc-400">
                                    {{ settings('currency')->code }}
                                </span>
                            </div>
                            @error('budget')
                                <p class="text-sm font-semibold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-3">
                            <label for="expected_duration" class="text-sm font-semibold text-slate-700 dark:text-zinc-200">
                                {{ __('messages.t_invite_freelancer_timeline') }}
                            </label>
                            <div class="relative">
                                <input
                                    id="expected_duration"
                                    type="number"
                                    min="1"
                                    max="365"
                                    wire:model.defer="expected_duration"
                                    class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-inner focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-white/10 dark:bg-white/5 dark:text-zinc-100 dark:focus:ring-primary-500/50"
                                    placeholder="7">
                                <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-xs font-semibold uppercase tracking-[0.2em] text-slate-400 dark:text-zinc-400">
                                    {{ __('messages.t_days') }}
                                </span>
                            </div>
                            @error('expected_duration')
                                <p class="text-sm font-semibold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-sm font-semibold text-slate-700 dark:text-zinc-200">
                            {{ __('messages.t_invite_freelancer_attachments') }}
                        </label>
                        <x-forms.filepond
                            wire:model="attachments"
                            allow-multiple="true"
                            :accepted-file-types="settings('publish')->custom_offer_attachments_allowed_extensions"
                            :max-files="settings('publish')->custom_offer_attachment_max_files"
                            :max-size="settings('publish')->custom_offer_attachment_max_size"
                            label-id="invite-attachments"
                            class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-6 dark:border-white/10 dark:bg-white/5" />
                        @error('attachments')
                            <p class="text-sm font-semibold text-red-500">{{ $message }}</p>
                        @enderror
                        @error('attachments.*')
                            <p class="text-sm font-semibold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="space-y-1 text-xs text-slate-500 dark:text-zinc-400">
                            <p>{{ __('messages.t_invite_freelancer_terms') }}</p>
                            <p class="text-slate-400">{{ __('messages.t_invite_freelancer_trust_hint') }}</p>
                        </div>

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                            <a href="{{ url('profile/' . $freelancer->username) }}" class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:text-primary-600 dark:border-white/15 dark:text-zinc-200 dark:hover:border-primary-500 dark:hover:text-primary-300">
                                <i class="ph-duotone ph-arrow-u-up-left text-lg"></i>
                                {{ __('messages.t_back_to_profile') }}
                            </a>
                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center justify-center gap-2 rounded-full bg-primary-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-primary-500/20 transition hover:-translate-y-0.5 hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:bg-primary-400">
                                <span wire:loading.remove wire:target="invite">{{ __('messages.t_invite_freelancer_cta') }}</span>
                                <span wire:loading wire:target="invite" class="inline-flex items-center gap-2">
                                    <svg class="h-4 w-4 animate-spin text-white" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                    </svg>
                                    {{ __('messages.t_processing') }}
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <aside class="space-y-8 rounded-3xl border border-slate-200 bg-gradient-to-b from-white via-white to-slate-50 p-8 shadow-lg dark:border-white/10 dark:from-white/10 dark:via-white/5 dark:to-white/0">
            <div class="flex items-center gap-4">
                <img
                    src="{{ src($freelancer->avatar?->path, 'avatar.jpg') }}"
                    alt="{{ $freelancer->username }}"
                    class="h-16 w-16 rounded-2xl object-cover ring-2 ring-primary-100 dark:ring-primary-500/30" />
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400 dark:text-zinc-500">
                        {{ __('messages.t_freelancer') }}
                    </p>
                    <p class="text-lg font-bold text-slate-900 dark:text-white">
                        {{ $freelancer->fullname ?: $freelancer->username }}
                    </p>
                    @if ($freelancer->country)
                        <p class="text-xs text-slate-500 dark:text-zinc-400">
                            <i class="ph-duotone ph-map-pin text-sm"></i>
                            {{ $freelancer->country->name }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="rounded-2xl bg-primary-50/80 p-5 text-sm text-primary-800 dark:bg-primary-500/10 dark:text-primary-100">
                <h2 class="flex items-center gap-2 text-sm font-semibold uppercase tracking-[0.25em] text-primary-500 dark:text-primary-200">
                    <i class="ph-duotone ph-scan text-base"></i>
                    {{ __('messages.t_invite_freelancer_filters_title') }}
                </h2>
                <p class="mt-3 leading-relaxed">
                    {{ __('messages.t_freelancers_directory_filters_copy') }}
                </p>
            </div>

            <div class="space-y-4 text-sm text-slate-600 dark:text-zinc-400">
                <div class="flex items-start gap-3">
                    <span class="mt-0.5 flex h-7 w-7 items-center justify-center rounded-full bg-primary-600/10 text-primary-600 dark:bg-primary-500/10 dark:text-primary-200">
                        <i class="ph-duotone ph-chat-circle-text text-base"></i>
                    </span>
                    <p>{{ __('messages.t_invite_freelancer_point_message') }}</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="mt-0.5 flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-300">
                        <i class="ph-duotone ph-shield-check text-base"></i>
                    </span>
                    <p>{{ __('messages.t_invite_freelancer_point_safety') }}</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="mt-0.5 flex h-7 w-7 items-center justify-center rounded-full bg-amber-500/10 text-amber-600 dark:bg-amber-500/10 dark:text-amber-300">
                        <i class="ph-duotone ph-clock-countdown text-base"></i>
                    </span>
                    <p>{{ __('messages.t_invite_freelancer_point_response') }}</p>
                </div>
            </div>
        </aside>
    </div>
</section>
