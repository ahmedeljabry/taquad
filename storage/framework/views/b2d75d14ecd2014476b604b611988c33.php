<?php
    $aiWidgetConfig = [
        'routes' => [
            'postProject'     => url('post/project'),
            'exploreProjects' => url('explore/projects'),
            'support'         => url('help/contact'),
            'knowledgebase'   => url('blog'),
        ],
        'copy' => [
            'success'  => __('messages.t_ai_widget_ticket_success'),
            'error'    => __('messages.t_ai_widget_ticket_error'),
            'fallback' => __('messages.t_ai_widget_fallback'),
            'thinking' => __('messages.t_ai_widget_thinking'),
            'toggle'   => __('messages.t_ai_widget_toggle_label'),
            'title'    => __('messages.t_ai_widget_title'),
            'tagline'  => __('messages.t_ai_widget_tagline'),
            'assistantTab' => __('messages.t_ai_widget_tab_assistant'),
            'ticketTab'    => __('messages.t_ai_widget_tab_ticket'),
            'greeting'     => __('messages.t_ai_widget_greeting'),
            'inputPlaceholder' => __('messages.t_ai_widget_input_placeholder'),
            'send'             => __('messages.t_ai_widget_send'),
            'name'             => __('messages.t_ai_widget_name'),
            'email'            => __('messages.t_ai_widget_email'),
            'topic'            => __('messages.t_ai_widget_topic'),
            'topicPlaceholder' => __('messages.t_ai_widget_topic_placeholder'),
            'priority'         => __('messages.t_ai_widget_priority'),
            'priorityNormal'   => __('messages.t_support_priority_normal'),
            'priorityHigh'     => __('messages.t_support_priority_high'),
            'priorityLow'      => __('messages.t_support_priority_low'),
            'message'          => __('messages.t_ai_widget_message'),
            'messagePlaceholder' => __('messages.t_ai_widget_message_placeholder'),
            'ticketHint'         => __('messages.t_ai_widget_ticket_hint'),
            'submit'             => __('messages.t_ai_widget_submit'),
            'noSuggestions'      => __('messages.t_ai_widget_no_suggestions') ?? 'ابحث باستخدام كلمات مفتاحية مختلفة.',
        ],
        'knowledge' => [
            [
                'question' => 'كيف أكتب موجز مشروع احترافي؟',
                'prefill'  => 'كيف أكتب موجز مشروع احترافي؟',
                'keywords' => ['وصف', 'brief', 'موجز', 'project'],
                'answer'   => '<strong>ثلاثة محاور أساسية:</strong><ul style="margin:0.35rem 0; padding-inline-start:1rem; list-style:disc;"><li><strong>النتيجة المطلوبة:</strong> صف ما تريد استلامه بلغة قابلة للقياس (مثال: “واجهة React جاهزة للربط مع API”).</li><li><strong>السياق والمراجع:</strong> أرفق أي ملفات أو روابط تشرح الهوية أو المستخدم النهائي.</li><li><strong>حدود الوقت والميزانية:</strong> حدّد موعد الإطلاق والمبلغ المخصص لكل مرحلة.</li></ul><a href="'.url('post/project').'" target="_blank" rel="noopener" class="ai-support-link-badge"><span>ابدأ النموذج الذكي</span><i class="ph ph-arrow-up-right"></i></a>',
            ],
            [
                'question' => 'كيف أضمن عروضاً عالية الجودة؟',
                'prefill'  => 'كيف أضمن عروضاً عالية الجودة؟',
                'keywords' => ['عروض', 'proposals', 'quality'],
                'answer'   => 'بعد نشر مشروعك:<ol style="margin:0.35rem 0; padding-inline-start:1rem;"><li>فعّل خيار <strong>“الخبراء المميزين”</strong> لتصل عروض من مستقلين حاصلين على تقييم 4.8+.</li><li>استخدم عامل التصفية حسب <strong>مدة الخبرة</strong> و<strong>مجال العمل</strong>.</li><li>اطلب من المستقلين مشاركة خطة التنفيذ ومثال لعمل مشابه.</li></ol>',
            ],
            [
                'question' => 'ما أفضل طريقة لمتابعة التقدم؟',
                'prefill'  => 'ما أفضل طريقة لمتابعة التقدم؟',
                'keywords' => ['متابعة', 'progress', 'timeline'],
                'answer'   => 'افتح لوحة المشروع وحدد موعد اجتماع أسبوعي قصير (15 دقيقة) للتأكيد على ما تم إنجازه وما سيُنجز. استخدم خاصية <strong>“المهام الذكية”</strong> لتوليد ملخص أسبوعي لحركة التنفيذ.',
            ],
            [
                'question' => 'كيف أحمي ميزانيتي؟',
                'prefill'  => 'كيف أحمي ميزانيتي؟',
                'keywords' => ['دفعات', 'حماية', 'ضمان', 'payment'],
                'answer'   => 'جميع الدفعات تمر عبر نظام الضمان. أضف المشروع كمراحل Milestones، ثم حرّر الدفعة فقط عند قبولك للتسليم. يمكنك كذلك تفعيل التنبيهات إذا تم تجاوز الوقت أو التكلفة المتفق عليها.',
            ],
            [
                'question' => 'ما الذي يميز “تعاقد” عن المنصات الأخرى؟',
                'prefill'  => 'ما الذي يميز تعاقد؟',
                'keywords' => ['ميزة', 'تعاقد', 'platform', 'why'],
                'answer'   => '<ul style="margin:0.35rem 0; padding-inline-start:1rem; list-style:disc;"><li><strong>المساعد العربي:</strong> ذكاء اصطناعي باللغة العربية يعالج الوصف والعروض ويقترح قرارات.</li><li><strong>انتقاء المستقلين:</strong> ملفات يتم اعتمادها يدوياً مع مؤشر احتراف موحّد.</li><li><strong>لوحة متابعة لحظية:</strong> مقاييس زمنية، تنبيهات تأخير، وجلسات فيديو مدمجة.</li></ul><a href="'.url('blog').'" target="_blank" rel="noopener" class="ai-support-link-badge"><span>تعرّف على حالات الاستخدام</span><i class="ph ph-arrow-up-right"></i></a>',
            ],
            [
                'question' => 'كيف أبدأ بسرعة بدون خبرة تقنية؟',
                'prefill'  => 'كيف أبدأ بسرعة بدون خبرة تقنية؟',
                'keywords' => ['ابدأ', 'بسرعة', 'غير تقني'],
                'answer'   => 'ابدأ بملء <strong>“قوالب المشاريع الجاهزة”</strong>، سيقوم النظام بترشيح المهارات والفريق. بعد ذلك احجز جلسة تعريفية مع أحد المستشارين (مجانية لمدة 15 دقيقة) لتأكيد خطة التنفيذ.',
            ],
        ],
    ];
?>
<?php if (! $__env->hasRenderedOnce('e7a8e04e-2d86-4d4e-bf60-0d8fca6398f3')): $__env->markAsRenderedOnce('e7a8e04e-2d86-4d4e-bf60-0d8fca6398f3'); ?>
    <style>
        #ai-support-widget {
            position: fixed;
            right: 2rem;
            bottom: 2rem;
            z-index: 60;
            pointer-events: none;
        }

        [dir="rtl"] #ai-support-widget {
            left: auto;
            right: 2rem;
        }

        .ai-support-toggle {
            pointer-events: auto;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            border-radius: 999px;
            background: linear-gradient(135deg, rgba(79, 70, 229, 1), rgba(30, 64, 175, 0.92));
            color: #fff;
            padding: 0.65rem 1.1rem;
            font-size: 0.82rem;
            font-weight: 600;
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.28);
            border: none;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .ai-support-toggle__icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 2.25rem;
            width: 2.25rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            font-size: 1.05rem;
        }

        .ai-support-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 36px rgba(37, 99, 235, 0.32);
        }

        @keyframes aiWidgetPulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 12px 30px rgba(37, 99, 235, 0.25);
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 18px 36px rgba(37, 99, 235, 0.32);
            }
        }

        #ai-support-widget:not(.is-open):not(.is-closing) .ai-support-toggle {
            animation: aiWidgetPulse 6s ease-in-out infinite;
        }

        .ai-support-panel {
            pointer-events: none;
            width: 348px;
            max-width: calc(100vw - 2.5rem);
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            box-shadow: 0 25px 80px rgba(15, 23, 42, 0.28);
            padding: 1.4rem 1.6rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            backdrop-filter: blur(16px);
            opacity: 0;
            visibility: hidden;
            transform: translateY(12px) scale(0.96);
            transition: opacity 0.28s ease, transform 0.28s ease;
        }

        #ai-support-widget.is-open .ai-support-panel {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        [data-ai-widget] .ai-support-panel[hidden] {
            display: none;
        }

        .ai-support-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .ai-support-header__title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #1f2937;
        }

        .ai-support-header__subtitle {
            font-size: 0.78rem;
            color: #475569;
            margin-top: 0.3rem;
            line-height: 1.6;
        }

        .ai-support-close {
            border: none;
            background: transparent;
            color: #94a3b8;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .ai-support-close:hover {
            color: #1f2937;
        }

        .ai-support-tabs {
            display: inline-flex;
            padding: 0.25rem;
            background: rgba(148, 163, 184, 0.12);
            border-radius: 999px;
            gap: 0.25rem;
            align-self: center;
        }

        .ai-support-tabs button {
            border: none;
            background: transparent;
            font-size: 0.78rem;
            font-weight: 600;
            color: #475569;
            padding: 0.45rem 0.9rem;
            border-radius: 999px;
            transition: all 0.2s ease;
        }

        .ai-support-tabs button.is-active {
            background: #ffffff;
            color: #1f2937;
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.18);
        }

        .ai-support-body {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .ai-support-body section[hidden] {
            display: none;
        }

        .ai-support-chat {
            max-height: 240px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            padding-inline-end: 0.25rem;
            scroll-behavior: smooth;
        }

        .ai-support-message {
            display: inline-flex;
            align-items: flex-start;
            gap: 0.6rem;
            font-size: 0.83rem;
            line-height: 1.6;
            max-width: 84%;
            border-radius: 18px;
            padding: 0.65rem 0.85rem;
            background: rgba(37, 99, 235, 0.08);
            color: #1f2937;
        }

        .ai-support-message.is-user {
            margin-inline-start: auto;
            justify-content: flex-end;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.95), rgba(79, 70, 229, 0.9));
            color: #fff;
        }

        .ai-support-message span {
            white-space: pre-wrap;
        }

        .ai-support-suggestions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.4rem;
        }

        .ai-support-suggestions button {
            border: none;
            background: rgba(37, 99, 235, 0.08);
            color: #1f2937;
            font-size: 0.72rem;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .ai-support-suggestions button:hover {
            background: rgba(37, 99, 235, 0.15);
            transform: translateY(-1px);
        }

        .ai-support-suggestion-empty {
            font-size: 0.72rem;
            color: #64748b;
            padding: 0.35rem 0.5rem;
        }

        .ai-support-link-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.1);
            color: #1f2937;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.35rem 0.7rem;
            margin: 0.2rem 0.15rem 0;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .ai-support-link-badge i {
            font-size: 0.9rem;
        }

        .ai-support-link-badge:hover {
            background: rgba(37, 99, 235, 0.18);
            color: #1d4ed8;
        }

        .ai-support-chat-form {
            margin-top: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(148, 163, 184, 0.4);
            border-radius: 999px;
            padding: 0.35rem 0.5rem 0.35rem 1rem;
        }

        .ai-support-chat-form input {
            flex: 1;
            border: none;
            background: transparent;
            font-size: 0.8rem;
            color: #1f2937;
        }

        .ai-support-chat-form input:focus {
            outline: none;
        }

        .ai-support-chat-form button {
            border: none;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.95), rgba(79, 70, 229, 0.95));
            color: #fff;
            width: 2.35rem;
            height: 2.35rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .ai-support-chat-form button:hover {
            transform: translateY(-1px);
        }

        .ai-support-ticket {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .ai-support-grid {
            display: grid;
            gap: 0.75rem;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .ai-support-label {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: #1f2937;
        }

        .ai-support-label input,
        .ai-support-label textarea,
        .ai-support-label select {
            border-radius: 12px;
            border: 1px solid rgba(148, 163, 184, 0.45);
            background: rgba(248, 250, 252, 0.9);
            padding: 0.6rem 0.75rem;
            font-size: 0.8rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .ai-support-label input:focus,
        .ai-support-label textarea:focus,
        .ai-support-label select:focus {
            outline: none;
            border-color: rgba(37, 99, 235, 0.6);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .ai-support-ticket-hint {
            font-size: 0.72rem;
            color: #64748b;
        }

        .ai-support-submit {
            border: none;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 1), rgba(59, 130, 246, 0.92));
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 0.75rem 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .ai-support-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 28px rgba(37, 99, 235, 0.28);
        }

        .ai-support-submit.is-loading {
            opacity: 0.75;
            cursor: progress;
        }

        .ai-support-feedback {
            font-size: 0.75rem;
            min-height: 1rem;
            margin-top: 0.35rem;
            color: #059669;
        }

        .ai-support-feedback.is-error {
            color: #dc2626;
        }

        @media (max-width: 640px) {
            #ai-support-widget {
                right: 1rem;
                bottom: 1rem;
            }

            [dir="rtl"] #ai-support-widget {
                left: 1rem;
            }

            .ai-support-panel {
                width: min(94vw, 360px);
            }
        }

        [data-theme='dark'] .ai-support-panel,
        body.dark .ai-support-panel {
            background: rgba(15, 23, 42, 0.94);
            border-color: rgba(148, 163, 184, 0.18);
            box-shadow: 0 28px 60px rgba(0, 0, 0, 0.45);
        }

        [data-theme='dark'] .ai-support-toggle,
        body.dark .ai-support-toggle {
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.32);
        }

        [data-theme='dark'] .ai-support-header__title,
        body.dark .ai-support-header__title {
            color: #e2e8f0;
        }

        [data-theme='dark'] .ai-support-header__subtitle,
        body.dark .ai-support-header__subtitle {
            color: #cbd5f5;
        }

        [data-theme='dark'] .ai-support-close,
        body.dark .ai-support-close {
            color: #cbd5f5;
        }

        [data-theme='dark'] .ai-support-close:hover,
        body.dark .ai-support-close:hover {
            color: #ffffff;
        }

        [data-theme='dark'] .ai-support-tabs,
        body.dark .ai-support-tabs {
            background: rgba(255, 255, 255, 0.08);
        }

        [data-theme='dark'] .ai-support-tabs button {
            color: #cbd5f5;
        }

        [data-theme='dark'] .ai-support-tabs button.is-active {
            background: rgba(255, 255, 255, 0.08);
            color: #f8fafc;
            box-shadow: none;
        }

        [data-theme='dark'] .ai-support-message,
        body.dark .ai-support-message {
            background: rgba(148, 163, 184, 0.12);
            color: #e2e8f0;
        }

        [data-theme='dark'] .ai-support-message.is-user,
        body.dark .ai-support-message.is-user {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.9), rgba(147, 197, 253, 0.85));
            color: #0f172a;
        }

        [data-theme='dark'] .ai-support-suggestions button,
        body.dark .ai-support-suggestions button {
            background: rgba(148, 163, 184, 0.18);
            color: #e2e8f0;
        }

        [data-theme='dark'] .ai-support-suggestion-empty,
        body.dark .ai-support-suggestion-empty {
            color: #cbd5f5;
        }

        [data-theme='dark'] .ai-support-link-badge,
        body.dark .ai-support-link-badge {
            background: rgba(148, 163, 184, 0.18);
            color: #e2e8f0;
        }

        [data-theme='dark'] .ai-support-link-badge:hover,
        body.dark .ai-support-link-badge:hover {
            background: rgba(59, 130, 246, 0.25);
            color: #bfdbfe;
        }

        [data-theme='dark'] .ai-support-chat-form,
        body.dark .ai-support-chat-form {
            border-color: rgba(148, 163, 184, 0.25);
            background: rgba(255, 255, 255, 0.05);
        }

        [data-theme='dark'] .ai-support-chat-form input,
        body.dark .ai-support-chat-form input {
            color: #e2e8f0;
        }

        [data-theme='dark'] .ai-support-label,
        body.dark .ai-support-label {
            color: #e2e8f0;
        }

        [data-theme='dark'] .ai-support-label input,
        [data-theme='dark'] .ai-support-label textarea,
        [data-theme='dark'] .ai-support-label select,
        body.dark .ai-support-label input,
        body.dark .ai-support-label textarea,
        body.dark .ai-support-label select {
            background: rgba(148, 163, 184, 0.12);
            border-color: rgba(148, 163, 184, 0.2);
            color: #f8fafc;
        }

        [data-theme='dark'] .ai-support-ticket-hint,
        body.dark .ai-support-ticket-hint {
            color: #cbd5f5;
        }

        [data-theme='dark'] .ai-support-feedback,
        body.dark .ai-support-feedback {
            color: #34d399;
        }

        [data-theme='dark'] .ai-support-feedback.is-error,
        body.dark .ai-support-feedback.is-error {
            color: #f87171;
        }
    </style>
<?php endif; ?>


<div id="ai-support-widget" class="ai-support-widget" data-ai-widget data-config='<?php echo json_encode($aiWidgetConfig, JSON_UNESCAPED_UNICODE, 512) ?>'>
    <button type="button" class="ai-support-toggle" data-widget-toggle aria-expanded="false" aria-controls="ai-support-panel">
        <span class="ai-support-toggle__icon">
            <i class="ph ph-sparkle"></i>
        </span>
        <span class="ai-support-toggle__text">
            <?php echo e($aiWidgetConfig['copy']['toggle'], false); ?>

        </span>
    </button>

    <div id="ai-support-panel" class="ai-support-panel" data-widget-panel hidden>
        <div class="ai-support-header">
            <div>
                <p class="ai-support-header__title"><?php echo e($aiWidgetConfig['copy']['title'], false); ?></p>
                <p class="ai-support-header__subtitle"><?php echo e($aiWidgetConfig['copy']['tagline'], false); ?></p>
            </div>
            <button type="button" class="ai-support-close" data-widget-close aria-label="<?php echo e(__('messages.t_close'), false); ?>">
                <i class="ph ph-x"></i>
            </button>
        </div>

        <div class="ai-support-tabs">
            <button type="button" class="is-active" data-widget-tab="assistant"><?php echo e($aiWidgetConfig['copy']['assistantTab'], false); ?></button>
            <button type="button" data-widget-tab="ticket"><?php echo e($aiWidgetConfig['copy']['ticketTab'], false); ?></button>
        </div>

        <div class="ai-support-body">
            <section data-widget-pane="assistant" class="is-active">
                <div class="ai-support-chat" data-widget-chat-log>
                    <div class="ai-support-message is-assistant">
                        <span><?php echo e($aiWidgetConfig['copy']['greeting'], false); ?></span>
                    </div>
                </div>

                <div class="ai-support-suggestions" data-widget-suggestions></div>

                <form class="ai-support-chat-form" data-widget-chat-form>
                    <input type="text" data-widget-chat-input autocomplete="off" placeholder="<?php echo e($aiWidgetConfig['copy']['inputPlaceholder'], false); ?>">
                    <button type="submit" aria-label="<?php echo e($aiWidgetConfig['copy']['send'], false); ?>">
                        <i class="ph ph-paper-plane-tilt"></i>
                    </button>
                </form>
            </section>

            <section data-widget-pane="ticket" hidden>
                <form class="ai-support-ticket" data-widget-ticket-form novalidate>
                    <div class="ai-support-grid">
                        <label class="ai-support-label">
                            <span><?php echo e($aiWidgetConfig['copy']['name'], false); ?></span>
                            <input type="text" name="name" required>
                        </label>
                        <label class="ai-support-label">
                            <span><?php echo e($aiWidgetConfig['copy']['email'], false); ?></span>
                            <input type="email" name="email" required>
                        </label>
                    </div>

                    <div>
                        <label class="ai-support-label">
                            <span><?php echo e($aiWidgetConfig['copy']['topic'], false); ?></span>
                            <input type="text" name="topic" placeholder="<?php echo e($aiWidgetConfig['copy']['topicPlaceholder'], false); ?>">
                        </label>
                        <label class="ai-support-label" style="display:none !important;">
                            <span><?php echo e($aiWidgetConfig['copy']['priority'], false); ?></span>
                            <select name="priority">
                                <option value="normal" selected><?php echo e($aiWidgetConfig['copy']['priorityNormal'], false); ?></option>
                                <option value="high"><?php echo e($aiWidgetConfig['copy']['priorityHigh'], false); ?></option>
                                <option value="low"><?php echo e($aiWidgetConfig['copy']['priorityLow'], false); ?></option>
                            </select>
                        </label>
                    </div>

                    <label class="ai-support-label">
                        <span><?php echo e($aiWidgetConfig['copy']['message'], false); ?></span>
                        <textarea name="message" rows="4" required placeholder="<?php echo e($aiWidgetConfig['copy']['messagePlaceholder'], false); ?>"></textarea>
                    </label>

                    <p class="ai-support-ticket-hint"><?php echo e($aiWidgetConfig['copy']['ticketHint'], false); ?></p>

                    <button type="submit" class="ai-support-submit" data-widget-ticket-submit>
                        <span><?php echo e($aiWidgetConfig['copy']['submit'], false); ?></span>
                        <i class="ph ph-arrow-up-right"></i>
                    </button>
                    <p class="ai-support-feedback" data-widget-ticket-feedback role="status" aria-live="polite"></p>
                </form>
            </section>
        </div>
    </div>
</div>

<?php if (! $__env->hasRenderedOnce('793aefdf-819a-47cf-9043-e1f3fc83dae2')): $__env->markAsRenderedOnce('793aefdf-819a-47cf-9043-e1f3fc83dae2'); ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const widgetRoot = document.querySelector('[data-ai-widget]');
        if (!widgetRoot) {
            return;
        }

        const config = JSON.parse(widgetRoot.dataset.config || '{}');
        const routes = config.routes || {};
        const copy = config.copy || {};
        const knowledgeBase = Array.isArray(config.knowledge) ? config.knowledge : [];
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        const supportEndpoint = "<?php echo e(route('support.widget.store'), false); ?>";
        const LINK_ICON = '<i class="ph ph-arrow-up-right" aria-hidden="true"></i>';

        const toggleBtn = widgetRoot.querySelector('[data-widget-toggle]');
        const closeBtn = widgetRoot.querySelector('[data-widget-close]');
        const panel = widgetRoot.querySelector('[data-widget-panel]');
        const tabs = Array.from(widgetRoot.querySelectorAll('[data-widget-tab]'));
        const panes = Array.from(widgetRoot.querySelectorAll('[data-widget-pane]'));
        const chatLog = widgetRoot.querySelector('[data-widget-chat-log]');
        const chatForm = widgetRoot.querySelector('[data-widget-chat-form]');
        const chatInput = widgetRoot.querySelector('[data-widget-chat-input]');
        const suggestionsContainer = widgetRoot.querySelector('[data-widget-suggestions]');
        const ticketForm = widgetRoot.querySelector('[data-widget-ticket-form]');
        const ticketSubmit = widgetRoot.querySelector('[data-widget-ticket-submit]');
        const ticketFeedback = widgetRoot.querySelector('[data-widget-ticket-feedback]');

        let closeTimeoutId = null;

        function setOpen(open) {
            widgetRoot.classList.toggle('is-open', open);
            widgetRoot.classList.toggle('is-closing', !open);
            panel.toggleAttribute('hidden', !open);
            toggleBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
            panel.setAttribute('aria-hidden', open ? 'false' : 'true');

            if (!open) {
                if (closeTimeoutId) {
                    clearTimeout(closeTimeoutId);
                }
                closeTimeoutId = setTimeout(() => {
                    widgetRoot.classList.remove('is-closing');
                }, 260);
            }
        }

        function scoreEntry(entry, term) {
            const normalized = term.toLowerCase();
            const keywordScore = (entry.keywords || []).reduce((score, keyword) => {
                return score + (normalized.includes((keyword || '').toLowerCase()) ? 1 : 0);
            }, 0);
            const questionScore = normalized.includes((entry.question || '').toLowerCase().slice(0, 6)) ? 1 : 0;
            return keywordScore + questionScore;
        }

        function getSuggestions(term = '') {
            const cleaned = term.trim();
            if (!cleaned) {
                return knowledgeBase.slice(0, 5);
            }

            const ranked = knowledgeBase
                .map((entry) => ({ entry, score: scoreEntry(entry, cleaned) }))
                .filter((item) => item.score > 0)
                .sort((a, b) => b.score - a.score)
                .map((item) => item.entry);

            if (ranked.length) {
                return ranked.slice(0, 5);
            }

            return knowledgeBase.slice(0, 5);
        }

        function renderSuggestions(suggestions) {
            suggestionsContainer.innerHTML = '';

            if (!suggestions.length) {
                const empty = document.createElement('span');
                empty.className = 'ai-support-suggestion-empty';
                empty.textContent = copy.noSuggestions || 'ابحث باستخدام كلمات مفتاحية مختلفة.';
                suggestionsContainer.appendChild(empty);
                return;
            }

            suggestions.forEach((suggestion) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = suggestion.question;
                button.dataset.prefill = suggestion.prefill || suggestion.question;
                suggestionsContainer.appendChild(button);
            });
        }

        function appendMessage(role, text) {
            const message = document.createElement('div');
            message.className = `ai-support-message ${role === 'user' ? 'is-user' : 'is-assistant'}`;
            const span = document.createElement('span');
            if (role === 'assistant') {
                span.innerHTML = text;
            } else {
                span.textContent = text;
            }
            message.appendChild(span);
            chatLog.appendChild(message);
            chatLog.scrollTo({ top: chatLog.scrollHeight, behavior: 'smooth' });
            return message;
        }

        function generateAnswer(query) {
            const normalized = query.trim().toLowerCase();
            if (!normalized.length) {
                return '';
            }

            const greetingPatterns = [/^hi\b/i, /^hello\b/i, /^hey\b/i, /^salam/i, /^مرحبا/i, /^اهلا/i, /^السلام/i, /^هلا/i];
            if (greetingPatterns.some((regex) => regex.test(normalized))) {
                return `مرحباً! يمكنني مساعدتك في نشر مشروعك أو استكشاف خبرائنا. جرّب <a href="${routes.postProject}" target="_blank" rel="noopener">إنشاء مشروع جديد</a> أو تصفّح <a href="${routes.exploreProjects}" target="_blank" rel="noopener">الخبراء المتاحين</a>.`;
            }

            const ranked = knowledgeBase
                .map((entry) => ({ entry, score: scoreEntry(entry, normalized) }))
                .filter((item) => item.score > 0)
                .sort((a, b) => b.score - a.score);

            if (ranked.length) {
                return ranked[0].entry.answer;
            }

            if (normalized.includes('رابط') || normalized.includes('link')) {
                return `إليك بعض الروابط المفيدة:<br>- <a href="${routes.postProject}" target="_blank" rel="noopener">نشر مشروع جديد</a><br>- <a href="${routes.exploreProjects}" target="_blank" rel="noopener">استكشاف المستقلين</a><br>- <a href="${routes.support}" target="_blank" rel="noopener">مركز المساعدة</a>`;
            }

            return `${copy.fallback} <br><br><a href="${routes.knowledgebase}" target="_blank" rel="noopener">مقالات مركز المعرفة</a> <a href="${routes.support}" target="_blank" rel="noopener">فتح تذكرة دعم</a>`;
        }

        function appendAssistantMessage(answer) {
            const message = appendMessage('assistant', answer);
            message.querySelectorAll('a').forEach((anchor) => {
                const href = anchor.getAttribute('href') || '#';
                const target = anchor.getAttribute('target') || '_blank';
                const rel = anchor.getAttribute('rel') || 'noopener';
                const text = anchor.textContent.trim() || href;

                const badge = document.createElement('a');
                badge.href = href;
                badge.target = target;
                badge.rel = rel;
                badge.className = 'ai-support-link-badge';
                badge.innerHTML = `<span>${text}</span>${LINK_ICON}`;

                anchor.replaceWith(badge);
            });
        }

        function handleOpen() {
            if (!widgetRoot.classList.contains('is-open')) {
                renderSuggestions(getSuggestions(chatInput.value));
                setOpen(true);
            } else {
                setOpen(false);
            }
        }

        toggleBtn.addEventListener('click', handleOpen);

        if (closeBtn) {
            closeBtn.addEventListener('click', () => setOpen(false));
        }

        document.addEventListener('click', (event) => {
            if (!widgetRoot.contains(event.target) && widgetRoot.classList.contains('is-open')) {
                setOpen(false);
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && widgetRoot.classList.contains('is-open')) {
                setOpen(false);
            }
        });

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                if (tab.classList.contains('is-active')) {
                    return;
                }
                tabs.forEach((btn) => btn.classList.toggle('is-active', btn === tab));
                panes.forEach((pane) => {
                    const isActive = pane.dataset.widgetPane === tab.dataset.widgetTab;
                    pane.classList.toggle('is-active', isActive);
                    pane.toggleAttribute('hidden', !isActive);
                });
                if (tab.dataset.widgetTab === 'assistant') {
                    renderSuggestions(getSuggestions(chatInput.value));
                    chatInput.focus({ preventScroll: true });
                }
            });
        });

        function submitQuery(rawQuery, options = {}) {
            const trimmed = (rawQuery || '').trim();
            if (!trimmed.length) {
                return;
            }

            appendMessage('user', trimmed);
            chatInput.value = '';
            renderSuggestions(getSuggestions());

            const thinking = appendMessage('assistant', copy.thinking || '...');
            thinking.classList.add('is-typing');

            setTimeout(() => {
                thinking.remove();
                const answer = generateAnswer(trimmed);
                if (answer) {
                    appendAssistantMessage(answer);
                }
                renderSuggestions(getSuggestions());
            }, options.instant ? 260 : 420);
        }

        suggestionsContainer.addEventListener('click', (event) => {
            const button = event.target.closest('button');
            if (!button) {
                return;
            }
            event.preventDefault();
            event.stopPropagation();
            setOpen(true);
            submitQuery(button.dataset.prefill || button.textContent, { instant: true });
            chatInput.focus({ preventScroll: true });
        });

        chatInput.addEventListener('input', () => {
            renderSuggestions(getSuggestions(chatInput.value));
        });

        chatForm.addEventListener('submit', (event) => {
            event.preventDefault();
            submitQuery(chatInput.value);
        });

        if (ticketForm && ticketSubmit && ticketFeedback) {
            ticketForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                const formData = new FormData(ticketForm);
                const payload = {
                    name: formData.get('name')?.toString().trim(),
                    email: formData.get('email')?.toString().trim(),
                    topic: formData.get('topic')?.toString().trim(),
                    priority: formData.get('priority')?.toString(),
                    message: formData.get('message')?.toString().trim()
                };

                ticketFeedback.textContent = '';
                ticketFeedback.classList.remove('is-error');
                ticketSubmit.classList.add('is-loading');
                ticketSubmit.disabled = true;

                try {
                    const response = await fetch(supportEndpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(payload)
                    });

                    if (!response.ok) {
                        const data = await response.json().catch(() => ({}));
                        const message = (data?.errors && Object.values(data.errors)[0][0]) || data?.message || copy.error || 'حدث خطأ غير متوقع.';
                        throw new Error(message);
                    }

                    ticketForm.reset();
                    ticketFeedback.textContent = copy.success || 'تم إرسال التذكرة بنجاح.';
                    ticketFeedback.classList.remove('is-error');
                } catch (error) {
                    ticketFeedback.textContent = error.message || copy.error || 'حدث خطأ غير متوقع.';
                    ticketFeedback.classList.add('is-error');
                } finally {
                    ticketSubmit.classList.remove('is-loading');
                    ticketSubmit.disabled = false;
                }
            });
        }

        renderSuggestions(getSuggestions());
    });
</script>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/layouts/partials/ai-widget.blade.php ENDPATH**/ ?>