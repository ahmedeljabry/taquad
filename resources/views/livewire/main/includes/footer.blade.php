@php
    $siteTitle     = settings('general')->title;
    $siteSubtitle  = settings('general')->subtitle;
    $footerLogo    = settings('general')->logo_dark ?: settings('general')->logo;
    $footerPages   = collect($pages);
    $columnOne     = $footerPages->where('column', 1);
    $columnTwo     = $footerPages->where('column', 2);
    $columnThree   = $footerPages->where('column', 3);
@endphp

<footer class="relative overflow-hidden bg-[#0b1220] pt-16 text-gray-200">
    <div aria-hidden class="absolute inset-0 opacity-40">
        <div class="absolute -top-32 -right-24 h-96 w-96 rounded-full bg-primary-500 blur-3xl"></div>
        <div class="absolute bottom-0 -left-24 h-[420px] w-[420px] rounded-full bg-amber-400 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.08),_transparent_55%)]"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        @guest
            {{-- Call to action --}}
            <div class="overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-primary-600 via-primary-500 to-amber-400 px-6 py-10 sm:px-10 sm:py-12 text-white shadow-2xl">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="space-y-3 text-right lg:text-right">
                        <p class="text-xs font-semibold uppercase tracking-[0.4em] text-white/80">جاهز للخطوة التالية؟</p>
                        <h2 class="text-2xl font-bold sm:text-3xl">ابنِ مشروعك مع فريق محترف يدعمه الذكاء الاصطناعي</h2>
                        <p class="text-sm text-white/80 max-w-2xl lg:ml-auto">
                            أطلق المشروع، تابع تنفيذه بدقة، واحصل على توصيات ذكية في كل مرحلة. نحن نجمع أفضل الخبرات في مكان واحد لتسريع نمو أعمالك.
                        </p>
                    </div>
                    <div class="flex flex-col items-stretch gap-3 sm:flex-row sm:items-center">
                        <a href="{{ url('post/project') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-primary-600 shadow-lg shadow-black/20 transition hover:-translate-y-0.5">
                            أضف مشروعاً جديداً
                            <i class="ph ph-arrow-up-right"></i>
                        </a>
                        <a href="{{ url('explore/projects') }}" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/60 px-6 py-3 text-sm font-semibold text-white/90 backdrop-blur transition hover:-translate-y-0.5 hover:bg-white/10">
                            استكشف المشاريع الجاهزة
                        </a>
                    </div>
                </div>
            </div>
        @endguest


        {{-- Footer grid --}}
        <div class="mt-14 grid gap-10 lg:grid-cols-5">

            {{-- Brand column --}}
            <div class="lg:col-span-2 space-y-6 text-right">
                @if ($footerLogo)
                    <a href="{{ url('/') }}" class="inline-flex items-center">
                        <img src="{{ src($footerLogo) }}" alt="{{ $siteTitle }}" class="h-10 w-auto">
                    </a>
                @else
                    <span class="text-2xl font-bold text-white">{{ $siteTitle }}</span>
                @endif
                <p class="text-sm leading-relaxed text-gray-400">
                    {{ $siteSubtitle }} — منصة موحدة تربطك بخبراء موهوبين في جميع أنحاء المنطقة، مع أدوات ذكية تضمن وضوح الأهداف ودقة النتائج.
                </p>
                <div class="flex flex-wrap items-center justify-end gap-3 text-xs text-gray-400">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 px-3 py-1">
                        <i class="ph ph-lock-open"></i>
                        دفع آمن
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 px-3 py-1">
                        <i class="ph ph-timer"></i>
                        دعم على مدار الساعة
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 px-3 py-1">
                        <i class="ph ph-globe"></i>
                        فرق موزعة عالميًا
                    </span>
                </div>
            </div>

            {{-- Column 1 --}}
            <div class="space-y-4 text-right">
                <h3 class="text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    {{ __('messages.t_footer_column_1') }}
                </h3>
                @if ($columnOne->count())
                    <ul class="space-y-3 text-sm text-gray-400">
                        @foreach ($columnOne as $page)
                            <li>
                                @if ($page->is_link && $page->link)
                                    <a href="{{ $page->link }}" target="_blank" class="transition hover:text-white">
                                        {{ $page->title }}
                                    </a>
                                @else
                                    <a href="{{ url('page', $page->slug) }}" class="transition hover:text-white">
                                        {{ $page->title }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Column 2 --}}
            <div class="space-y-4 text-right">
                <h3 class="text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    {{ __('messages.t_footer_column_2') }}
                </h3>
                @if ($columnTwo->count())
                    <ul class="space-y-3 text-sm text-gray-400">
                        @foreach ($columnTwo as $page)
                            <li>
                                @if ($page->is_link && $page->link)
                                    <a href="{{ $page->link }}" target="_blank" class="transition hover:text-white">
                                        {{ $page->title }}
                                    </a>
                                @else
                                    <a href="{{ url('page', $page->slug) }}" class="transition hover:text-white">
                                        {{ $page->title }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Column 3 and utilities --}}
            <div class="space-y-6 text-right">
                <div class="space-y-4">
                    <h3 class="text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                        {{ __('messages.t_footer_column_3') }}
                    </h3>
                    @if ($columnThree->count())
                        <ul class="space-y-3 text-sm text-gray-400">
                            @foreach ($columnThree as $page)
                                <li>
                                    @if ($page->is_link && $page->link)
                                        <a href="{{ $page->link }}" target="_blank" class="transition hover:text-white">
                                            {{ $page->title }}
                                        </a>
                                    @else
                                        <a href="{{ url('page', $page->slug) }}" class="transition hover:text-white">
                                            {{ $page->title }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="space-y-3">
                    <h4 class="text-xs font-semibold uppercase tracking-[0.4em] text-white/70">تابعنا</h4>
                    <div class="flex flex-wrap items-center justify-end gap-3">
                        @if (settings('footer')->social_facebook)
                            <a href="{{ settings('footer')->social_facebook }}" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#1877f2] text-white transition hover:bg-opacity-80"> <i class="ph ph-facebook-logo"></i> </a>
                        @endif
                        @if (settings('footer')->social_twitter)
                            <a href="{{ settings('footer')->social_twitter }}" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#1da1f2] text-white transition hover:bg-opacity-80"> <i class="ph ph-twitter-logo"></i> </a>
                        @endif
                        @if (settings('footer')->social_instagram)
                            <a href="{{ settings('footer')->social_instagram }}" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-tr from-[#f09433] via-[#e6683c] to-[#bc1888] text-white transition hover:opacity-90"> <i class="ph ph-instagram-logo"></i> </a>
                        @endif
                        @if (settings('footer')->social_linkedin)
                            <a href="{{ settings('footer')->social_linkedin }}" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#0a66c2] text-white transition hover:bg-opacity-80"> <i class="ph ph-linkedin-logo"></i> </a>
                        @endif
                        @if (settings('footer')->social_youtube)
                            <a href="{{ settings('footer')->social_youtube }}" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#ff0000] text-white transition hover:bg-opacity-75"> <i class="ph ph-youtube-logo"></i> </a>
                        @endif
                        @if (settings('footer')->social_whatsapp)
                            <a href="{{ settings('footer')->social_whatsapp }}" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#25d366] text-white transition hover:bg-opacity-80"> <i class="ph ph-whatsapp-logo"></i> </a>
                        @endif
                        @if (settings('footer')->social_telegram)
                            <a href="{{ settings('footer')->social_telegram }}" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#26A5E4] text-white transition hover:bg-opacity-80"> <i class="ph ph-paper-plane-tilt"></i> </a>
                        @endif
                        @if (settings('footer')->social_vk)
                            <a href="{{ settings('footer')->social_vk }}" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#0077FF] text-white transition hover:bg-opacity-80"> <i class="ph ph-globe-hemisphere-east"></i> </a>
                        @endif
                    </div>
                </div>

                <div class="flex flex-wrap items-center justify-end gap-3">
                    @if (settings('footer')->is_language_switcher)
                        <div class="rounded-full border border-white/15 px-4 py-2">
                            @livewire('main.partials.languages')
                        </div>
                    @endif

                    @if (settings('appearance')->is_theme_switcher)
                        <div x-data="themeToggle()">
                            <button type="button"
                                class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-white/10 text-white transition hover:bg-white/20 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/40"
                                @click="setTheme(preference === 'dark' ? 'light' : 'dark')">
                                <span class="sr-only">{{ __('messages.t_theme_toggle') }}</span>
                                <i :class="preference === 'dark' ? 'ph ph-sun' : 'ph ph-moon'"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Bottom bar --}}
        <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-white/10 py-6 text-xs text-gray-400 sm:flex-row">
            <p class="order-2 sm:order-1">© {{ date('Y') }} {{ $siteTitle }}. جميع الحقوق محفوظة.</p>
            <div class="order-1 sm:order-2 flex flex-wrap items-center gap-3 text-xs text-gray-400">
                <span class="inline-flex items-center gap-2">
                    <i class="ph ph-shield-check"></i>
                    شهادات أمان محدثة
                </span>
                <span class="inline-flex items-center gap-2">
                    <i class="ph ph-credit-card"></i>
                    طرق دفع متعددة
                </span>
            </div>
        </div>

    </div>
</footer>
