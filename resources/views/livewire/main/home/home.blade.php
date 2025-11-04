<div>
    <div class="w-full">
        @php

            $featuredCategories = cache()->remember('home_featured_categories', 3600, function () {
                return \App\Models\ProjectCategory::limit(8)->get();
            });


            $metrics = cache()->remember('home_metrics_counters', 3600, function () {
                return [
                    'projects' => \App\Models\Project::whereIn('status', ['completed', 'active'])->count(),
                    'sellers' => \App\Models\User::where('account_type', 'seller')->whereIn('status', ['active', 'verified'])->count(),
                    'clients' => \App\Models\User::where('account_type', 'buyer')->count(),
                ];
            });

            $metrics = array_map(fn($value) => max(0, (int) $value), $metrics);

            $metricsLabels = [
                'projects' => 'مشروع موثّق',
                'sellers' => 'خبير محترف',
                'clients' => 'عميل موثوق',
            ];

            $metricsIcons = [
                'projects' => 'ph-duotone ph-rocket-launch',
                'sellers' => 'ph-duotone ph-users-three',
                'clients' => 'ph-duotone ph-handshake',
            ];

            $howItWorks = [
                [
                    'step' => '١',
                    'title' => 'صف مشروعك بالتفصيل',
                    'description' => 'حدد الأهداف، المهارات المطلوبة، والميزانية المناسبة لمشروعك في دقائق.',
                ],
                [
                    'step' => '٢',
                    'title' => 'استقبل العروض الفورية',
                    'description' => 'يعرض عليك نخبة الخبراء حلولهم وتقديراتهم لضمان اختيار الأنسب.',
                ],
                [
                    'step' => '٣',
                    'title' => 'تواصل وابدأ التنفيذ',
                    'description' => 'ناقش التفاصيل عبر المحادثات المدمجة وحدد جدول العمل بكل وضوح.',
                ],
                [
                    'step' => '٤',
                    'title' => 'استلم العمل وادفع بأمان',
                    'description' => 'أطلق الدفع عند استلام النتائج المعتمدة واحصل على متابعة ما بعد التسليم.',
                ],
            ];

            $valueProps = [
                [
                    'icon' => 'ph-users-three',
                    'title' => 'خبراء مختارون بعناية',
                    'description' => 'تحقق يدوي من الملفات التعريفية يوماً بعد يوم لضمان معايير احترافية عالية.',
                ],
                [
                    'icon' => 'ph-lightning',
                    'title' => 'سرعة في الإنجاز',
                    'description' => 'نظام مطابقة ذكي يقرّبك من المنفّذين الأكفاء خلال ساعات قليلة.',
                ],
                [
                    'icon' => 'ph-shield-check',
                    'title' => 'ضمان دفع محمي',
                    'description' => 'إيداع آمن مع خطط دفع مرنة، وتحرير الدفعة فقط بعد موافقتك النهائية.',
                ],
            ];

            $aiHighlights = [
                [
                    'icon' => 'ph-robot',
                    'title' => 'مساعد ذكاء اصطناعي بالعربية',
                    'description' => 'يساعدك على صياغة وصف المشروع، اقتراح المهارات المناسبة، وتحديد الميزانية المثالية خلال ثوانٍ.',
                ],
                [
                    'icon' => 'ph-magic-wand',
                    'title' => 'تلخيص العروض فور وصولها',
                    'description' => 'يقرأ العروض المطروحة ويمنحك ملخصاتٍ فورية ونقاط قوة وضعف لكل مستقل حتى تختار بثقة.',
                ],
                [
                    'icon' => 'ph-clipboard-check',
                    'title' => 'متابعة التنفيذ الذكية',
                    'description' => 'ينبّهك للمهام المتأخرة ويقترح خطوات تصحيحية لتحافظ على سير المشروع وفق الخطة.',
                ],
            ];

            $futureLaunches = [
                [
                    'icon' => 'ph-device-mobile',
                    'badge' => 'قريباً',
                    'title' => 'تطبيق الهاتف',
                    'subtitle' => 'راقب فريقك أينما كنت',
                    'description' => 'إشعارات فورية، متابعة المهام بالذكاء الاصطناعي، وتوقيع العقود عبر الهاتف لعالم عمل أكثر مرونة.',
                ],
                [
                    'icon' => 'ph-timer',
                    'badge' => 'قيد التطوير',
                    'title' => 'تعقب الساعات الذكي',
                    'subtitle' => 'لوحة شفافة لساعات العمل',
                    'description' => 'سجل تلقائي لساعات المستقلين، تنبيهات تجاوز الحدود، وتصدير الفواتير بنقرة واحدة.',
                ],
                [
                    'icon' => 'ph-currency-circle-dollar',
                    'badge' => 'قريباً',
                    'title' => 'مدفوعات مجدولة',
                    'subtitle' => 'دفع مرن لمراحل عملك',
                    'description' => 'قم بجدولة المدفوعات حسب المراحل، أطلقها تلقائياً عند الموافقة، وراقب التدفق النقدي لحظياً.',
                ],
            ];

            $testimonials = [
                [
                    'name' => 'مها القحطاني',
                    'role' => 'رائدة أعمال - الرياض',
                    'quote' => 'وجدت فريق التسويق الرقمي خلال ٤٨ ساعة. أطلقنا الحملة في الوقت المحدد وبنتائج ملموسة.',
                    'initials' => 'م ق',
                ],
                [
                    'name' => 'سليمان العتيبي',
                    'role' => 'مدير تقنية - جدة',
                    'quote' => 'المستقلون هنا يفهمون خصوصية السوق المحلي. بناء المنصة تم بجودة تفوق المعايير العالمية.',
                    'initials' => 'س ع',
                ],
                [
                    'name' => 'ريم النجار',
                    'role' => 'صاحبة متجر إلكتروني - دبي',
                    'quote' => 'إدارة المشروع كانت سهلة وواضحة. وفرت المنصة تقارير تنفيذ دورية وفريق دعم متجاوب.',
                    'initials' => 'ر ن',
                ],
            ];

            $faqs = [
                [
                    'question' => 'هل يمكنني اختيار المستقل المناسب بنفسي؟',
                    'answer' => 'بالتأكيد. يمكنك مقارنة العروض، الاطلاع على الملفات التعريفية، التقييمات، ونماذج الأعمال قبل تأكيد الاتفاق.',
                ],
                [
                    'question' => 'كيف تضمن المنصة جودة التنفيذ؟',
                    'answer' => 'نراجع الحسابات يدوياً، ونوفر أدوات للتواصل وتسليم الملفات، إضافة إلى خاصية ربط الدفع بمرحلة الموافقات.',
                ],
                [
                    'question' => 'ما هي طرق الدفع المتاحة؟',
                    'answer' => 'ندعم التحويل البنكي، الدفع بالبطاقات، وخيارات الفوترة المحلية مثل مدى، أبل باي، ومدفوعات شركات الاتصالات.',
                ],
                [
                    'question' => 'هل يمكن تقسيم المشروع إلى مراحل؟',
                    'answer' => 'نعم، يمكنك إنشاء مخطط مراحل Milestones وربط كل مرحلة بدفعة منفصلة لضمان تقدم العمل وفق الخطة.',
                ],
                [
                    'question' => 'هل يوجد دعم مخصص للشركات؟',
                    'answer' => 'فريق نجاح العملاء متوفر لمساعدتك في بناء فرق عمل كاملة وتوفير تقارير مفصلة عن الأداء والتكاليف.',
                ],
            ];

            $topSellers = collect($sellers ?? []);
            $featuredProjects = collect($projects ?? []);
        @endphp

        <section id="hero" class="relative overflow-hidden bg-[#f6f9ff] dark:bg-[#080d17]">
            <div aria-hidden class="pointer-events-none absolute inset-0">
                <div class="absolute -top-32 ltr:-left-32 rtl:-right-32 h-[420px] w-[420px] rounded-full bg-primary-500/10 blur-3xl"
                    data-float data-float-distance="42" data-float-duration="9"></div>
                <div class="absolute bottom-0 ltr:-right-24 rtl:-left-24 h-[380px] w-[380px] rounded-full bg-amber-300/20 blur-3xl"
                    data-float data-float-distance="32" data-float-duration="7" data-float-direction="-1"></div>
            </div>

            <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 pt-36 pb-28 lg:pt-40 lg:pb-36">
                <div class="grid gap-16 lg:grid-cols-[1.1fr_1fr] lg:items-center">
                    <div class="text-right lg:text-right space-y-8" data-animate data-animate-delay="0.05">
                        <div class="inline-flex items-center gap-2 rounded-full border border-white/60 bg-white/80 px-4 py-1.5 text-sm font-semibold text-gray-700 shadow-sm backdrop-blur dark:border-white/10 dark:bg-white/5 dark:text-gray-200"
                            data-hero-segment>
                            <i class="ph ph-cpu text-primary-600 text-lg"></i>
                            منصة ذكاء اصطناعي ترافقك من الفكرة إلى التسليم
                        </div>

                        <h1 class="text-4xl font-black leading-snug text-slate-900 sm:text-5xl md:text-6xl dark:text-white" data-hero-segment style="line-height: 80px;padding:10px;border-radus:50%;">
                            قدّم فكرتك، شكّل فريقك،
                            <span id="hero-dynamic-text" class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 via-primary-600 to-amber-500" style="border:2px solid #f59e0b;border-radius: 14px;padding: 6px;font-size: 68px;"></span>
                        </h1>

                        <p class="max-w-xl text-sm leading-relaxed text-gray-600 dark:text-gray-300 lg:ml-auto"
                            data-hero-segment>
                            مساعدنا الذكي يصوغ وصف مشروعك بالعربية، يبني قائمة المهارات المطلوبة، ويتابع التنفيذ برسوم
                            بيانية حيّة. أنت تركّز على الهدف، وهو يتولّى التفاصيل.
                        </p>

                        <div class="flex flex-col items-stretch justify-end gap-3 sm:flex-row sm:items-center sm:justify-end"
                            data-hero-segment>
                            <a href="{{ url('post/project') }}" class="inline-flex items-center justify-center rounded-full bg-primary-600 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-primary-500/25 transition hover:-translate-y-0.5 hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary-500" data-hero-segment>
                                أطلق مشروعاً جديداً
                            </a>
                            <button type="button" data-scroll-target="#ai-suite"
                                class="inline-flex items-center justify-center gap-2 rounded-full border border-gray-300 px-7 py-3 text-sm font-semibold text-gray-700 transition hover:-translate-y-0.5 hover:border-primary-500 hover:text-primary-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary-500 dark:border-gray-700 dark:text-gray-200 dark:hover:border-primary-400 dark:hover:text-primary-300"
                                data-hero-segment>
                                <i class="ph ph-arrow-line-down"></i>
                                تعرّف على مزايا الذكاء الاصطناعي
                            </button>
                        </div>

                        <div id="hero-pills" class="flex flex-wrap items-center justify-end gap-2" data-animate
                            data-animate-delay="0.15" data-hero-segment>
                            <button type="button" data-hero-pill
                                class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-gray-600 shadow-sm transition hover:-translate-y-0.5 hover:text-primary-600 dark:bg-white/10 dark:text-gray-200">
                                <i class="ph ph-lightning"></i>
                                ترجمة فورية للعروض
                            </button>
                            <button type="button" data-hero-pill
                                class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-gray-600 shadow-sm transition hover:-translate-y-0.5 hover:text-primary-600 dark:bg-white/10 dark:text-gray-200">
                                <i class="ph ph-chart-line"></i>
                                لوحة تحكم لحظية
                            </button>
                            <button type="button" data-hero-pill
                                class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-gray-600 shadow-sm transition hover:-translate-y-0.5 hover:text-primary-600 dark:bg-white/10 dark:text-gray-200">
                                <i class="ph ph-shield-check"></i>
                                حماية دفع ذكية
                            </button>
                            <button type="button" data-hero-pill
                                class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-gray-600 shadow-sm transition hover:-translate-y-0.5 hover:text-primary-600 dark:bg-white/10 dark:text-gray-200">
                                <i class="ph ph-users-three"></i>
                                خبراء معتمدون
                            </button>
                        </div>
                    </div>

                    <div class="relative" data-animate data-animate-delay="0.15">
                        <figure class="relative mx-auto max-w-[420px]" data-parallax data-parallax-y="35"
                            data-hero-segment>
                            <svg viewBox="0 0 420 420" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="w-full h-full">
                                <defs>
                                    <linearGradient id="hero-gradient" x1="0" y1="0" x2="1" y2="1">
                                        <stop offset="0" stop-color="#2563eb" stop-opacity="0.25" />
                                        <stop offset="1" stop-color="#f59e0b" stop-opacity="0.45" />
                                    </linearGradient>
                                </defs>
                                <path id="hero-path-line" d="M30 340 C 140 260, 120 120, 320 80"
                                    stroke="url(#hero-gradient)" stroke-width="3" stroke-linecap="round"
                                    opacity="0.85" />
                                <path id="hero-blob"
                                    d="M287 95C323 123 326 180 301 220C276 260 223 282 182 270C141 258 112 211 121 165C130 120 177 76 226 71C254 69 274 76 287 95Z"
                                    fill="url(#hero-gradient)" opacity="0.35" />
                                <path id="hero-blob-alt"
                                    d="M300 140C332 170 328 225 296 260C264 296 204 312 166 290C128 268 112 208 130 160C148 112 200 76 246 84C272 88 287 111 300 140Z"
                                    fill="url(#hero-gradient)" opacity="0" />
                            </svg>

                            <div class="absolute inset-0 flex items-center justify-center">
                                <div
                                    class="w-60 rounded-3xl bg-white/80 p-5 text-right shadow-xl backdrop-blur dark:bg-white/10">
                                    <div class="text-xs font-semibold text-primary-600 dark:text-primary-300">تحديث
                                        المشروع المباشر</div>
                                    <div class="mt-3 space-y-3 text-xs text-gray-600 dark:text-gray-200">
                                        <div class="flex items-center justify-between">
                                            <span>تقدم المهام</span>
                                            <span class="font-semibold">72%</span>
                                        </div>
                                        <div class="h-1.5 overflow-hidden rounded-full bg-gray-200 dark:bg-white/10">
                                            <span
                                                class="block h-full w-[72%] rounded-full bg-gradient-to-r from-primary-500 to-amber-400"></span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span>مستقلون متاحون</span>
                                            <span
                                                class="font-semibold text-primary-600 dark:text-primary-300">+18</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span>توصيات الذكاء الاصطناعي</span>
                                            <span class="flex items-center gap-1 text-emerald-500"><i
                                                    class="ph ph-arrow-up-right"></i>5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="absolute -bottom-10 ltr:-left-6 rtl:-right-6 flex w-full items-center justify-between text-xs text-gray-500 dark:text-gray-300">
                                <div class="rounded-2xl bg-white px-4 py-2 shadow-sm dark:bg-white/10">
                                    <div class="font-semibold text-gray-700 dark:text-white">متوسط زمن الرد</div>
                                    <div class="text-primary-600 dark:text-primary-300">٤ ساعات</div>
                                </div>
                                <div class="rounded-2xl bg-white px-4 py-2 shadow-sm dark:bg-white/10">
                                    <div class="font-semibold text-gray-700 dark:text-white">نسبة نجاح المشاريع</div>
                                    <div class="text-primary-600 dark:text-primary-300">٩٣٪</div>
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative mt-0 pb-16 pt-10">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <div class="relative overflow-hidden rounded-[28px] border border-slate-200/70 bg-gradient-to-br from-white/95 via-white/90 to-primary-50/40 p-8 shadow-xl shadow-slate-900/5 backdrop-blur-lg dark:border-white/10 dark:from-[#0f172a]/95 dark:via-[#111b2f]/90 dark:to-primary-500/10"
                    data-animate data-animate-delay="0.15">
                    <div class="pointer-events-none absolute -right-24 -top-24 h-52 w-52 rounded-full bg-primary-500/15 blur-3xl dark:bg-primary-500/20"></div>
                    <div class="pointer-events-none absolute -bottom-20 -left-20 h-48 w-48 rounded-full bg-amber-400/10 blur-3xl dark:bg-amber-300/15"></div>
                    <div class="relative grid gap-8 sm:grid-cols-3">
                        @foreach ($metrics as $key => $value)
                            <div class="group flex flex-col items-center gap-4 text-center">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-white/90 shadow-lg shadow-primary-500/10 ring-1 ring-white/60 transition group-hover:-translate-y-1 dark:bg-slate-900/80 dark:ring-white/5">
                                    <i class="{{ $metricsIcons[$key] ?? 'ph-duotone ph-sparkle' }} text-xl text-primary-600 dark:text-primary-300"></i>
                                </div>
                                <div class="text-4xl font-black tracking-tight text-slate-900 dark:text-zinc-50">
                                    <span data-counter data-counter-value="{{ $value }}">{{ number_format($value) }}</span>
                                    <span class="text-primary-600 dark:text-primary-300">+</span>
                                </div>
                                <p class="text-[13px] font-semibold uppercase tracking-[0.3em] text-slate-500 dark:text-zinc-400">
                                    {{ $metricsLabels[$key] ?? '' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="relative overflow-hidden py-20">
            <div aria-hidden class="absolute inset-0 bg-gradient-to-br from-slate-100 via-white to-primary-50 dark:from-[#0f172a] dark:via-[#0b1220] dark:to-[#111827]"></div>
            <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div class="space-y-3" data-animate>
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/80 px-4 py-1 text-xs font-semibold text-primary-600 shadow-sm backdrop-blur dark:bg-white/10 dark:text-primary-300">
                            <i class="ph ph-rocket-launch text-sm"></i>
                            خارطة الطريق
                        </span>
                        <h2 class="text-3xl font-bold leading-tight text-gray-900 dark:text-white sm:text-4xl">
                            نُطلق قريباً أدوات تجعل العمل الحر أكثر مرونة
                        </h2>
                        <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            تابع التحديثات القادمة: تطبيق جوال مُصمم لإدارة المشروع أثناء التنقل، وتعقب ساعات متقدم بإشعارات ذكية، ومنظومة دفع مرنة مهيأة للفرق المتعددة. شاركنا رأيك واختر الميزات التي تهمك ليتم إطلاقها أولاً.
                        </p>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl border border-white/60 bg-white/80 px-5 py-4 shadow-lg backdrop-blur dark:border-white/10 dark:bg-white/5" data-animate data-animate-delay="0.1">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary-600/90 text-white shadow-md shadow-primary-500/30">
                            <i class="ph ph-bell-ringing text-lg"></i>
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">
                            <p class="font-semibold">اشترك في نشرة التحديثات</p>
                            <p>أول من يعلم بإطلاق التطبيق وتعقب الساعات.</p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($futureLaunches as $release)
                        <div class="group relative overflow-hidden rounded-3xl border border-white/70 bg-white/80 p-6 shadow-lg backdrop-blur transition hover:-translate-y-1 hover:shadow-2xl dark:border-white/10 dark:bg-white/5" data-animate data-animate-delay="{{ $loop->index * 0.08 }}">
                            <div class="absolute -right-10 top-0 h-32 w-32 rounded-full bg-primary-500/10 blur-3xl transition group-hover:bg-primary-500/20"></div>
                            <div class="flex items-center justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-600/90 text-white shadow-md shadow-primary-500/30">
                                    <i class="ph {{ $release['icon'] }} text-2xl"></i>
                                </div>
                                <span class="inline-flex items-center gap-1 rounded-full bg-primary-100 px-3 py-1 text-[11px] font-semibold text-primary-700 dark:bg-primary-500/15 dark:text-primary-300">
                                    <i class="ph ph-hourglass-medium text-sm"></i>
                                    {{ $release['badge'] }}
                                </span>
                            </div>
                            <div class="mt-6 space-y-2">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $release['title'] }}</h3>
                                <p class="text-sm font-medium text-primary-600 dark:text-primary-300">{{ $release['subtitle'] }}</p>
                                <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">{{ $release['description'] }}</p>
                            </div>
                            <div class="mt-6">
                                <div class="flex items-center justify-between text-[11px] uppercase tracking-[0.2em] text-gray-400 dark:text-gray-500">
                                    <span>مستوى الطلب</span>
                                    <span>{{ 65 + $loop->index * 12 }}%</span>
                                </div>
                                <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-700">
                                    <div class="h-full rounded-full bg-gradient-to-r from-primary-500 to-indigo-500 transition-all duration-500 group-hover:from-primary-400 group-hover:to-indigo-400" style="width: {{ 45 + $loop->index * 18 }}%;"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        @if ($featuredCategories->isNotEmpty())
            <section id="featured-categories" class="bg-white py-20 dark:bg-[#080d17]">
                <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                    <div class="mb-12 text-center" data-animate>
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-4 py-1 text-sm font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                            القطاعات الأكثر طلباً
                        </span>
                        <h2 class="mt-4 text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
                            مجالات تناسب نمو أعمالك
                        </h2>
                        <p class="mt-3 text-gray-600 dark:text-gray-300">
                            اختر من بين المجالات الأكثر نشاطاً وابدأ فوراً مع محترفين يفهمون السوق المحلي.
                        </p>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($featuredCategories as $category)
                            <a href="{{ url('categories', $category->slug) }}"
                                class="group relative overflow-hidden rounded-3xl bg-gray-900/90 text-white shadow-lg transition hover:-translate-y-1 hover:shadow-2xl"
                                data-animate data-animate-delay="0.1">
                                <span class="absolute inset-0 opacity-70 transition duration-500 group-hover:scale-105"
                                    style="background-image: url('{{ src($category->image) }}'); background-size: cover; background-position: center;"></span>
                                <span class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent"></span>
                                <div class="relative flex h-52 flex-col justify-end p-6">
                                    <span
                                        class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">{{ __('messages.t_explore_more') }}</span>
                                    <span class="mt-3 text-xl font-bold leading-tight">{{ $category->name }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section id="how-it-works"
            class="bg-gradient-to-b from-white to-primary-50/40 py-20 dark:from-[#080d17] dark:to-[#0f172a]/60">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-5">
                    <div class="lg:col-span-2" data-animate>
                        <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">رحلة متكاملة لإنجاز
                            المشاريع</h2>
                        <p class="mt-4 text-gray-600 dark:text-gray-300">
                            من دراسة الفكرة حتى إطلاق المنتج، كل خطوة موثقة، مدعومة، وآمنة. صُممت هذه التجربة لتلائم
                            احتياجات الشركات ورواد الأعمال في المنطقة.
                        </p>
                    </div>
                    <div class="grid gap-6 lg:col-span-3 sm:grid-cols-2">
                        @foreach ($howItWorks as $step)
                            <div class="rounded-3xl border border-white/50 bg-white/80 p-6 shadow-sm backdrop-blur transition hover:-translate-y-1 hover:shadow-lg dark:border-white/10 dark:bg-white/5"
                                data-animate data-animate-delay="0.1">
                                <div class="flex items-center justify-between text-primary-600">
                                    <span class="text-sm font-semibold">{{ $step['step'] }}</span>
                                    <i class="ph ph-arrow-elbow-down-right"></i>
                                </div>
                                <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">{{ $step['title'] }}
                                </h3>
                                <p class="mt-3 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                                    {{ $step['description'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
                    <div class="space-y-5" data-animate>
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-4 py-1 text-sm font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                            ما الذي يميّز تجربة إدارة المشاريع لدينا؟
                        </span>
                        <h2 class="text-3xl font-bold leading-snug text-gray-900 sm:text-4xl dark:text-white">
                            ثلاث ركائز تضمن سير العمل بسلاسة: دقة المعطيات، سرعة الاستجابة، واستباق المخاطر.
                        </h2>
                        <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            فريقك يرى مشهد التنفيذ كاملاً: توصيات قبلية من الذكاء الاصطناعي، أدوات تواصل مترابطة، وخدمات
                            دعم ميداني متى احتجت لها. كل ركيزة مصممة لتقليل الوقت وتضخيم النتائج.
                        </p>
                    </div>

                    <div class="relative pl-10" data-animate data-animate-delay="0.1">
                        <span aria-hidden
                            class="absolute top-0 bottom-0 ltr:left-4 rtl:right-4 w-[2px] rounded-full bg-gradient-to-b from-primary-400 via-primary-500/40 to-transparent"></span>
                        <div class="space-y-8">
                            @foreach ($valueProps as $index => $prop)
                                <div
                                    class="relative rounded-3xl border border-white/70 bg-white/90 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-white/10 dark:bg-white/5">
                                    <span aria-hidden
                                        class="absolute -right-2 top-6 hidden h-3 w-3 rounded-full bg-primary-500 shadow-md shadow-primary-400 ltr:left-[-11px] rtl:right-[-11px] lg:block"></span>
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-primary-500 to-amber-400 text-white shadow-lg shadow-primary-500/30">
                                            <i class="ph {{ $prop['icon'] }} text-2xl"></i>
                                        </div>
                                        <div>
                                            <p
                                                class="text-xs font-semibold uppercase tracking-[0.35em] text-primary-600 dark:text-primary-300">
                                                {{ sprintf('%02d', $index + 1) }}
                                            </p>
                                            <h3 class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">
                                                {{ $prop['title'] }}
                                            </h3>
                                        </div>
                                    </div>
                                    <p class="mt-4 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                                        {{ $prop['description'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="ai-suite" class="relative overflow-hidden py-20">
            <div aria-hidden
                class="absolute inset-0 bg-gradient-to-br from-primary-100 via-white to-amber-100 dark:from-[#172554] dark:via-[#0f172a] dark:to-[#1d1b38]">
            </div>
            <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-5 items-center">
                    <div class="lg:col-span-2 space-y-5" data-animate>
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-white/70 px-4 py-1 text-sm font-semibold text-primary-600 shadow-sm backdrop-blur dark:bg-white/10 dark:text-primary-300">
                            مساعد الذكاء الاصطناعي من المنصة
                        </span>
                        <h2 class="text-3xl font-bold leading-tight text-gray-900 sm:text-4xl dark:text-white">
                            دعم ذكي يختصر عليك وقت التخطيط والمراجعة
                        </h2>
                        <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            صمّمنا مساعد ذكاء اصطناعي باللغة العربية ليتابع رحلتك منذ كتابة الطلب وحتى تسليم المشروع.
                            اطرح أسئلتك عليه، اطلب ملخّصات، أو دعْه يقترح خطواتٍ قادمة داخل لوحة التحكم.
                        </p>
                        <div class="flex flex-wrap gap-3 pt-2" data-animate data-animate-delay="0.1">
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-4 py-2 text-xs font-semibold text-white">
                                <i class="ph ph-chat-circle-text text-base"></i>
                                دردشة فورية داخل لوحة القيادة
                            </span>
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-semibold text-primary-600 shadow-sm dark:bg-white/10 dark:text-primary-300">
                                <i class="ph ph-brain text-base"></i>
                                نصائح تنفيذ مخصّصة
                            </span>
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-semibold text-primary-600 shadow-sm dark:bg-white/10 dark:text-primary-300">
                                <i class="ph ph-notification text-base"></i>
                                تنبيهات استباقية بالتأخّر
                            </span>
                        </div>
                    </div>

                    <div class="lg:col-span-3 grid gap-6 sm:grid-cols-2" data-animate data-animate-delay="0.2">
                        @foreach ($aiHighlights as $feature)
                            <div
                                class="rounded-3xl border border-white/60 bg-white/80 p-6 shadow-lg backdrop-blur transition hover:-translate-y-1 hover:shadow-2xl dark:border-white/10 dark:bg-white/5">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-600/90 text-white shadow-lg shadow-primary-500/30">
                                    <i class="ph {{ $feature['icon'] }} text-2xl"></i>
                                </div>
                                <h3 class="mt-6 text-lg font-semibold text-gray-900 dark:text-white">{{ $feature['title'] }}
                                </h3>
                                <p class="mt-3 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                                    {{ $feature['description'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        @if (settings('appearance')->is_best_sellers && $topSellers->isNotEmpty())
            <section id="top-sellers"
                class="bg-gradient-to-b from-primary-50/60 via-white to-white py-20 dark:from-[#0f172a] dark:via-[#0b1220] dark:to-[#080d17]">
                <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-6 text-center sm:text-right sm:flex-row sm:items-end sm:justify-between"
                        data-animate>
                        <div>
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1 text-sm font-semibold text-primary-600 shadow dark:bg-white/10 dark:text-primary-300">
                                {{ __('messages.t_top_sellers') }}
                            </span>
                            <h2 class="mt-3 text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
                                محترفون مستعدون للانضمام إلى فريقك
                            </h2>
                        </div>
                        <a href="{{ url('sellers') }}"
                            class="inline-flex items-center justify-center rounded-full border border-transparent bg-primary-600 px-6 py-2 text-sm font-semibold text-white shadow transition hover:-translate-y-0.5 hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary-500">
                            {{ __('messages.t_view_more') }}
                        </a>
                    </div>

                    <div class="mt-12 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($topSellers->take(6) as $seller)
                            <div class="flex h-full flex-col rounded-3xl border border-white/60 bg-white/80 p-6 shadow-md backdrop-blur transition hover:-translate-y-1 hover:shadow-xl dark:border-white/10 dark:bg-white/5"
                                data-animate>
                                <div class="flex items-center gap-4">
                                    <a href="{{ url('profile', $seller->username) }}" target="_blank"
                                        class="relative inline-flex">
                                        <img class="h-16 w-16 rounded-2xl object-cover lazy" src="{{ placeholder_img() }}"
                                            data-src="{{ src($seller->avatar) }}" alt="{{ $seller->username }}">
                                        @if ($seller->isOnline() && !$seller->availability)
                                            <span
                                                class="absolute -top-1 -left-1 block h-3 w-3 rounded-full bg-green-400 ring-2 ring-white dark:ring-gray-900"></span>
                                        @elseif ($seller->availability)
                                            <span
                                                class="absolute -top-1 -left-1 block h-3 w-3 rounded-full bg-gray-400 ring-2 ring-white dark:ring-gray-900"></span>
                                        @else
                                            <span
                                                class="absolute -top-1 -left-1 block h-3 w-3 rounded-full bg-red-400 ring-2 ring-white dark:ring-gray-900"></span>
                                        @endif
                                    </a>
                                    <div>
                                        <a href="{{ url('profile', $seller->username) }}" target="_blank"
                                            class="flex items-center gap-1 text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $seller->username }}
                                            @if ($seller->status === 'verified')
                                                <img class="h-4 w-4" src="{{ url('public/img/auth/verified-badge.svg') }}"
                                                    alt="{{ __('messages.t_account_verified') }}">
                                            @endif
                                        </a>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                                            {{ optional($seller->level)->title }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center gap-2 text-sm text-amber-500">
                                    <i class="ph ph-star-fill"></i>
                                    @if ($seller->rating() == 0)
                                        <span class="font-semibold tracking-wide">{{ __('messages.t_n_a') }}</span>
                                    @else
                                        <span class="font-semibold tracking-wide">{{ $seller->rating() }}</span>
                                    @endif
                                    <span
                                        class="text-gray-400 dark:text-gray-300">({{ number_format($seller->reviews()->count()) }})</span>
                                </div>

                                <div class="mt-4 flex flex-wrap gap-2">
                                    @if ($seller->skills()->count())
                                        @foreach ($seller->skills()->inRandomOrder()->limit(3)->get() as $skill)
                                            <span
                                                class="inline-flex items-center rounded-full bg-primary-50 px-3 py-1 text-xs font-medium text-primary-700 dark:bg-primary-500/10 dark:text-primary-300">
                                                {{ $skill->name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span
                                            class="text-xs text-gray-400 dark:text-gray-300">{{ __('messages.t_no_skills_yet') }}</span>
                                    @endif
                                </div>

                                <div class="mt-auto flex gap-3 pt-6">
                                    @auth
                                        <a href="{{ url('messages/new', $seller->username) }}"
                                            class="flex-1 rounded-2xl bg-primary-600 py-2.5 text-center text-sm font-semibold text-white shadow transition hover:-translate-y-0.5 hover:bg-primary-700">
                                            {{ __('messages.t_contact_me') }}
                                        </a>
                                    @endauth
                                    <a href="{{ url('profile', $seller->username) }}"
                                        class="flex-1 rounded-2xl border border-gray-200 py-2.5 text-center text-sm font-semibold text-gray-700 transition hover:-translate-y-0.5 hover:border-primary-500 hover:text-primary-600 dark:border-gray-700 dark:text-gray-200 dark:hover:border-primary-400 dark:hover:text-primary-300">
                                        {{ __('messages.t_view_profile') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if (settings('projects')->is_enabled && $featuredProjects->isNotEmpty())
            <section id="featured-projects" class="py-20">
                <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-6 text-center sm:text-right sm:flex-row sm:items-end sm:justify-between"
                        data-animate>
                        <div>
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-4 py-1 text-sm font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                                {{ __('messages.t_featured_projects') }}
                            </span>
                            <h2 class="mt-3 text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
                                فرص جاهزة للانطلاق
                            </h2>
                        </div>
                        <a href="{{ url('explore/projects') }}"
                            class="inline-flex items-center justify-center rounded-full border border-transparent bg-primary-600 px-6 py-2 text-sm font-semibold text-white shadow transition hover:-translate-y-0.5 hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary-500">
                            {{ __('messages.t_view_more') }}
                        </a>
                    </div>

                    <div class="mt-12 space-y-6" data-animate data-animate-delay="0.1">
                        @foreach ($featuredProjects as $project)
                            @livewire('main.cards.project', ['id' => $project->uid], key('project-card-id-' . $project->uid))
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section
            class="bg-gradient-to-b from-white via-primary-50/60 to-white py-20 dark:from-[#080d17] dark:via-[#0f172a] dark:to-[#080d17]">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-1" data-animate>
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1 text-sm font-semibold text-primary-600 shadow dark:bg-white/10 dark:text-primary-300">
                            قصص نجاح حقيقية
                        </span>
                        <h2 class="mt-4 text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
                            تجارب تثبت قوة العمل عبر المنصة
                        </h2>
                        <p class="mt-3 text-gray-600 dark:text-gray-300">
                            نرافقك في كل خطوة من اختيار الفريق وحتى التطوير والتسليم. هذه بعض القصص من عملائنا في مختلف
                            القطاعات.
                        </p>
                    </div>
                    <div class="lg:col-span-2 grid gap-6 sm:grid-cols-2">
                        @foreach ($testimonials as $testimonial)
                            <div class="relative overflow-hidden rounded-3xl bg-white/80 p-6 shadow-md backdrop-blur transition hover:-translate-y-1 hover:shadow-xl dark:bg-white/5"
                                data-animate data-animate-delay="0.1">
                                <div
                                    class="absolute -top-10 -right-6 text-[6rem] text-primary-100/70 dark:text-primary-500/10">
                                    “</div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-600 text-sm font-bold text-white">
                                        {{ $testimonial['initials'] }}
                                    </div>
                                    <div>
                                        <p class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $testimonial['name'] }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-300">{{ $testimonial['role'] }}</p>
                                    </div>
                                </div>
                                <p class="mt-4 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                                    {{ $testimonial['quote'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="py-20">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center" data-animate>
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-4 py-1 text-sm font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                        الأسئلة الأكثر تداولاً
                    </span>
                    <h2 class="mt-4 text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
                        دعم واضح في كل مرحلة
                    </h2>
                    <p class="mt-3 text-gray-600 dark:text-gray-300">
                        نساعدك على إطلاق مشروعك بثقة من خلال توضيح أبرز الأسئلة التي تصلنا من رواد الأعمال والشركات.
                    </p>
                </div>

                <div class="space-y-4" data-animate data-animate-delay="0.1">
                    @foreach ($faqs as $faq)
                        <details
                            class="group rounded-2xl border border-gray-200 bg-white/90 p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg open:border-primary-200 open:bg-white dark:border-gray-700 dark:bg-white/5 dark:open:border-primary-500/40"
                            {{ $loop->first ? 'open' : '' }}>
                            <summary
                                class="flex cursor-pointer items-center justify-between text-right text-base font-semibold text-gray-900 marker:text-transparent dark:text-white">
                                <span>{{ $faq['question'] }}</span>
                                <i class="ph ph-plus text-xl transition group-open:rotate-45"></i>
                            </summary>
                            <p class="mt-4 text-sm leading-loose text-gray-600 dark:text-gray-300">{{ $faq['answer'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        @if (settings('newsletter')->is_enabled)
            <section id="newsletter" class="py-20">
                <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden rounded-3xl bg-gradient-to-br from-primary-600 via-primary-500 to-amber-400 p-1 shadow-xl">
                        <div class="rounded-[22px] bg-white/95 px-6 py-10 sm:px-10 dark:bg-gray-900/90" data-animate>
                            <div class="mx-auto max-w-3xl text-center">
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">اشترك في نشرات السوق الأسبوعية
                                </h3>
                                <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">نرسل لك تحليلات الطلب، فرص
                                    المشاريع، وأفضل النصائح لإدارة الفرق المستقلة.</p>
                                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                                    <label for="newsletter-email"
                                        class="sr-only">{{ __('messages.t_enter_email_address') }}</label>
                                    <input wire:model.defer="email" id="newsletter-email" type="text" autocomplete="email"
                                        required placeholder="{{ __('messages.t_enter_email_address') }}"
                                        class="h-14 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm text-gray-900 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100"
                                        readonly onfocus="this.removeAttribute('readonly');">
                                    <button wire:click="newsletter" wire:loading.attr="disabled" wire:target="newsletter"
                                        type="button"
                                        class="h-14 rounded-2xl bg-primary-600 px-6 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-primary-700 disabled:cursor-not-allowed disabled:bg-primary-400">
                                        {{ __('messages.t_signup') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="pb-20">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="relative overflow-hidden rounded-4xl bg-gradient-to-br from-primary-600 via-primary-500 to-amber-400 px-8 py-16 text-center text-white shadow-xl"
                    data-animate>
                    <div
                        class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'400\' height=\'400\' viewBox=\'0 0 400 400\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cdefs%3E%3ClinearGradient id=\'g\' x1=\'50%25\' y1=\'0%25\' x2=\'50%25\' y2=\'100%25\'%3E%3Cstop stop-color=\'%23ffffff\' stop-opacity=\'0.08\' offset=\'0%25\'/%3E%3Cstop stop-color=\'%23ffffff\' stop-opacity=\'0\' offset=\'100%25\'/%3E%3C/linearGradient%3E%3Cpattern id=\'p\' width=\'60\' height=\'60\' patternUnits=\'userSpaceOnUse\'%3E%3Cpath d=\'M0 59h60v1H0zM59 0v60h1V0z\' fill=\'url(%23g)\'/%3E%3C/pattern%3E%3C/defs%3E%3Crect width=\'400\' height=\'400\' fill=\'url(%23p)\'/%3E%3C/svg%3E')] opacity-20">
                    </div>
                    <div class="relative space-y-6">
                        <h2 class="text-3xl font-bold sm:text-4xl">جاهز لإطلاق مشروعك التالي؟</h2>
                        <p class="mx-auto max-w-2xl text-sm leading-relaxed text-white/80">
                            اجمع أفضل الخبرات في فريق واحد، راقب التنفيذ خطوة بخطوة، وحافظ على السيطرة على التكلفة
                            والوقت.
                        </p>
                        <div class="flex flex-col items-center justify-center gap-3 sm:flex-row sm:gap-4">
                            <a href="{{ url('post/project') }}"
                                class="inline-flex items-center justify-center rounded-full bg-white px-8 py-3 text-sm font-semibold text-primary-600 shadow-lg shadow-black/10 transition hover:-translate-y-0.5">
                                أضف مشروعاً جديداً
                            </a>
                            <a href="{{ url('explore/projects') }}"
                                class="inline-flex items-center justify-center rounded-full border border-white/70 px-8 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-white/10">
                                استكشف مجتمع المستقلين
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Flip.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/TextPlugin.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollToPlugin.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Observer.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://assets.codepen.io/16327/DrawSVGPlugin3.min.js"></script>
    <script src="https://assets.codepen.io/16327/MorphSVGPlugin3.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof gsap === 'undefined') {
                return;
            }

            const pluginCandidates = [window.ScrollTrigger, window.ScrollToPlugin, window.Flip, window.TextPlugin].filter(Boolean);

            if (pluginCandidates.length) {
                gsap.registerPlugin(...pluginCandidates);
            }

            const heroSegments = gsap.utils.toArray('[data-hero-segment]');
            if (heroSegments.length) {
                gsap.set(heroSegments, { opacity: 0, y: 36 });
                gsap.timeline({ delay: 0.25, defaults: { duration: 0.9, ease: 'power3.out' } })
                    .to(heroSegments, { opacity: 1, y: 0, stagger: 0.12 });
            }

            const heroHeadline = document.querySelector('#hero-dynamic-text');
            if (heroHeadline && window.TextPlugin) {
                const heroTexts = [
                    'ذكي',
                    'مبدع',
                    'دقيق'
                ];

                const textTimeline = gsap.timeline({ paused: true, repeat: -1, repeatDelay: 1 });
                heroTexts.forEach((text) => {
                    textTimeline.to(heroHeadline, { duration: 1.15, text, ease: 'power2.out' });
                    textTimeline.to(heroHeadline, { duration: 0.45, text: '', ease: 'power2.in', delay: 1.2 });
                });

                if (window.ScrollTrigger) {
                    ScrollTrigger.create({
                        trigger: '#hero',
                        start: 'top center',
                        onEnter: () => textTimeline.play(),
                        onLeaveBack: () => textTimeline.pause(0)
                    });
                } else {
                    textTimeline.play();
                }
            }

            const heroUnderline = document.getElementById('hero-underline');
            if (heroUnderline) {
                gsap.fromTo(heroUnderline, { scaleX: 0 }, {
                    scaleX: 1,
                    duration: 1,
                    ease: 'power3.out',
                    delay: 0.6,
                    transformOrigin: 'left'
                });
            }

            document.querySelectorAll('[data-scroll-target]').forEach((button) => {
                button.addEventListener('click', (event) => {
                    const selector = button.getAttribute('data-scroll-target');
                    const target = document.querySelector(selector);
                    if (target && window.ScrollToPlugin) {
                        event.preventDefault();
                        gsap.to(window, { duration: 0.9, scrollTo: target, ease: 'power2.out' });
                    }
                });
            });

            gsap.utils.toArray('[data-float]').forEach((element) => {
                const distance = parseFloat(element.dataset.floatDistance || '22');
                const duration = parseFloat(element.dataset.floatDuration || '6');
                const direction = parseFloat(element.dataset.floatDirection || '1');
                gsap.to(element, {
                    y: distance * direction,
                    duration,
                    ease: 'sine.inOut',
                    repeat: -1,
                    yoyo: true,
                    delay: Math.random() * 1.25
                });
            });

            if (window.ScrollTrigger) {
                gsap.utils.toArray('[data-parallax]').forEach((element) => {
                    const offset = parseFloat(element.dataset.parallaxY || '40');
                    gsap.fromTo(element, { y: offset }, {
                        y: -offset,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: element,
                            start: 'top bottom',
                            end: 'bottom top',
                            scrub: true
                        }
                    });
                });

                const heroSection = document.getElementById('hero');
                if (heroSection) {
                    ScrollTrigger.create({
                        trigger: heroSection,
                        start: 'top top',
                        end: 'bottom top+=120',
                        onToggle: (state) => heroSection.classList.toggle('hero-active', state.isActive)
                    });
                }

                const heroPills = document.querySelector('#hero-pills');
                if (heroPills && window.Flip) {
                    heroPills.querySelectorAll('[data-hero-pill]').forEach((pill) => {
                        pill.addEventListener('click', () => {
                            const state = Flip.getState(heroPills.children);
                            heroPills.prepend(pill);
                            Flip.from(state, {
                                duration: 0.6,
                                ease: 'power2.out',
                                stagger: 0.04
                            });
                        });
                    });
                }

                ScrollTrigger.batch('[data-animate]:not([data-hero-segment])', {
                    start: 'top 78%',
                    onEnter: (batch) => {
                        batch.forEach((element) => {
                            const delay = parseFloat(element.dataset.animateDelay || '0');
                            const y = parseFloat(element.dataset.animateY || '50');
                            gsap.fromTo(element, { y, opacity: 0 }, {
                                y: 0,
                                opacity: 1,
                                duration: 0.9,
                                ease: 'power3.out',
                                delay,
                                overwrite: 'auto'
                            });
                        });
                    }
                });

                const numberFormatter = new Intl.NumberFormat('ar-SA');
                gsap.utils.toArray('[data-counter]').forEach((counter) => {
                    const target = parseInt(counter.dataset.counterValue || '0', 10);
                    ScrollTrigger.create({
                        trigger: counter,
                        start: 'top 85%',
                        once: true,
                        onEnter: () => {
                            const state = { value: 0 };
                            counter.textContent = numberFormatter.format(0);
                            gsap.to(state, {
                                value: target,
                                duration: 1.6,
                                ease: 'power3.out',
                                onUpdate: () => {
                                    counter.textContent = numberFormatter.format(Math.round(state.value));
                                }
                            });
                        }
                    });
                });
            }
        });
    </script>
@endpush
