<?php

namespace App\Livewire\Main\Desktop;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class AppComponent extends Component
{
    use SEOToolsTrait;

    #[Layout('components.layouts.main-app')]
    public function render()
    {
        $title       = 'تطبيق Taquad Desktop لتتبع الوقت وإدارة النشاط';
        $description = 'حمّل تطبيق Taquad Desktop للبقاء على اطلاع على ساعات الفريق والتنبيهات دون الحاجة للمتصفح. نسخة ويندوز مستقرة ونسخة macOS تجريبية. ';
        $ogImage     = src(settings('seo')->ogimage);

        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $this->seo()->setCanonical(url()->current());
        $this->seo()->opengraph()->setTitle($title);
        $this->seo()->opengraph()->setDescription($description);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addImage($ogImage);
        $this->seo()->twitter()->setTitle($title);
        $this->seo()->twitter()->setDescription($description);
        $this->seo()->twitter()->setUrl(url()->current());
        $this->seo()->twitter()->addImage($ogImage);

        $downloadLinks = [
            [
                'platform' => 'ويندوز 11/10',
                'icon'     => 'ph-microsoft-windows-logo',
                'status'   => 'مستقر',
                'size'     => '32.9 MB',
                'hash'     => '5FE1B44F1D733FAE32254D20C27D7A597EB4CCD31FD889107562AED3D157C0A2',
                'cta'      => 'تحميل فوري',
                'href'     => asset('apps/desktop/taquad-desktop-win.exe'),
            ],
            [
                'platform' => 'macOS 13+',
                'icon'     => 'ph-apple-logo',
                'status'   => 'Beta',
                'size'     => '1.2 MB',
                'hash'     => '7C77B8E12F6B4F9C0990EE6E54CD78AAA183BA70486B22C62942B91D524A4FE4',
                'cta'      => 'تنزيل نسخة المعاينة',
                'href'     => asset('apps/desktop/taquad-desktop-mac-preview.zip'),
            ],
        ];

        $featureBlocks = [
            [
                'icon'  => 'ph-clock-countdown',
                'title' => 'تعقب ساعات دقيق',
                'body'  => 'بدء وإيقاف المؤقت من شريط النظام، مع ربط كل دقيقة بالمهام والمراحل داخل لوحة التحكم.',
            ],
            [
                'icon'  => 'ph-plug-charging',
                'title' => 'مزامنة بلا انقطاع',
                'body'  => 'يُخزّن التطبيق النشاط دون اتصال ويعكسه تلقائياً حال توفر الشبكة مع إشعارات فورية.',
            ],
            [
                'icon'  => 'ph-chart-line-up',
                'title' => 'رؤية فورية للأداء',
                'body'  => 'لوحات مصغّرة تُظهر المخاطر والمهام المتأخرة، لتعديل الخطط قبل فوات الأوان.',
            ],
        ];

        $betaHighlights = [
            [
                'title' => 'مؤشرات جودة العمل',
                'desc'  => 'يتحقق التطبيق من تغيّر النشاط ويعطي تقييماً تلقائياً لجلسات العمل ذات التركيز.',
            ],
            [
                'title' => 'مربعات محادثة في كل مشروع',
                'desc'  => 'ارسل الملاحظات من التطبيق المكتبي مباشرة إلى لوحة المحادثات داخل المشروع.',
            ],
            [
                'title' => 'تنبيهات ذكية للمديرين',
                'desc'  => 'استقبل إشعاراً عند توقف أحد أفراد الفريق أو تجاوز الحدود الزمنية للمهمة.',
            ],
        ];

        $timeline = [
            [
                'label' => 'الإصدار 0.3',
                'title' => 'لوحة مؤقت غنية',
                'body'  => 'إدارة جلسات متعددة ومتابعة جودة النشاط لحظة بلحظة.',
            ],
            [
                'label' => 'الإصدار 0.4',
                'title' => 'تكامل المدفوعات الذكي',
                'body'  => 'إقفال المراحل وإطلاق الدفعات المجدولة مباشرة من التطبيق المكتبي.',
            ],
            [
                'label' => 'الإصدار 0.5',
                'title' => 'دعم كامل لنظام macOS',
                'body'  => 'توقيع متقدم وتوزيع عبر متجر التطبيقات مع تحديثات تلقائية.',
            ],
        ];

        $faqs = [
            [
                'q' => 'هل التطبيق آمن للشركات؟',
                'a' => 'يعمل التطبيق عبر قنوات HTTPS ويستخدم نفس معايير التشفير وحسابات الأذونات في لوحة التحكم الرئيسية.',
            ],
            [
                'q' => 'هل يمكن استخدامه دون اتصال؟',
                'a' => 'نعم، تُحفظ الجلسات محلياً وتُرسل حال عودة الإنترنت مع سجل واضح للمزامنة.',
            ],
            [
                'q' => 'هل النسخة الماك متوافقة مع شرائح Apple Silicon؟',
                'a' => 'النسخة الحالية هي معاينة تعتمد على واجهة الويب وتحتاج للسماح من System Settings، وسيتم استبدالها ببناء أصلي عند الإصدار 0.5.',
            ],
        ];

        $installationGuides = [
            [
                'platform' => 'ويندوز',
                'icon'     => 'ph-microsoft-windows-logo',
                'subtitle' => 'ملف تثبيت تقليدي (Setup.exe)',
                'steps'    => [
                    'حمّل الملف ثم انقر نقراً مزدوجاً لبدء المعالج.',
                    'اختر مجلد التثبيت واضغط Next حتى تظهر شاشة Finish.',
                    'بعد الانتهاء سيظهر التطبيق في قائمة ابدأ ويمكن تشغيله بصلاحيات عادية.',
                ],
            ],
            [
                'platform' => 'macOS',
                'icon'     => 'ph-apple-logo',
                'subtitle' => 'نسخة معاينة تحتاج للسماح من Privacy & Security',
                'steps'    => [
                    'فك الضغط عن الملف ثم اسحب Taquad Desktop.app إلى مجلد Applications.',
                    'من System Settings > Privacy & Security اضغط Open Anyway للسماح بالنسخة.',
                    'بعد الإطلاق الأول يتعامل التطبيق كأي تطبيق أصلي ويمكن تثبيته في Dock.',
                ],
            ],
        ];

        $updateHighlights = [
            [
                'icon'  => 'ph-arrow-clockwise',
                'title' => 'تنبيه داخل التطبيق',
                'desc'  => 'بمجرد توفر إصدار أحدث يظهر إشعار واضح مع زر Download & Update يعيد تشغيل التطبيق بعد تثبيت الحزمة.',
            ],
            [
                'icon'  => 'ph-cloud-arrow-down',
                'title' => 'ملفات موقعة من المنصة',
                'desc'  => 'كل تحديث يُحمّل من خوادم Taquad مع بصمة SHA256 ظاهرة لضمان عدم العبث.',
            ],
            [
                'icon'  => 'ph-gear-six',
                'title' => 'إدارة مرنة',
                'desc'  => 'يمكن للمستخدم تأجيل التحديث أو إعادته لاحقاً من قائمة الإعدادات > التحديثات.',
            ],
        ];

        return view('livewire.main.desktop.app', [
            'downloadLinks'  => $downloadLinks,
            'featureBlocks'  => $featureBlocks,
            'betaHighlights' => $betaHighlights,
            'timeline'       => $timeline,
            'faqs'           => $faqs,
            'installationGuides' => $installationGuides,
            'updateHighlights'   => $updateHighlights,
        ]);
    }
}
