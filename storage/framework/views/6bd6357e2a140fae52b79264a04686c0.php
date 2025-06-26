<div class="w-full">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css'>

    <style type="text/css">
        :root {
            --primary-color: #0c81e4;
            --secondary-color: #06599e;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
            --color-text: rgba(18, 17, 0.72);
            --color-title: #121127;
        }

        .hero__wrapper {
            height: calc(100vh - 4.5rem);
            display: flex;
            flex-direction: column;
            text-align: center;
            align-items: center;
            justify-content: center;
        }

        .hero__wrapper-txt {
            margin-bottom: 54px;
            text-align: center;
            margin-bottom: 54px;
        }

        .hero__wrapper-txt .title {
            font-weight: 700;
            font-size: 74.628px;
            line-height: 120%;
            color: var(--color-title);
            margin-bottom: 27px;
            line-height: 148%;
        }

        .hero__wrapper-txt .info {
            font-weight: 400;
            font-size: 26.6528px;
            line-height: 180%;
        }

        .hero__wrapper:before {
            content: '';
            position: absolute;
            z-index: -1;
            width: 640px;
            height: 640px;
            filter: blur(266.528px);
            opacity: 0.5;
            background: #ff96d5;

        }

        .hero__wrapper:before {
            top: 50%;
            left: 65%;
            transform: translate(-50%, -50%);
        }

        .hero__wrapper:after {
            content: '';
            position: absolute;
            z-index: -1;
            width: 640px;
            height: 640px;
            filter: blur(266.528px);
            opacity: 0.5;
            background: #FFD391;
        }

        .hero__wrapper:after {
            top: 50%;
            right: 65%;
            transform: translate(50%, -50%);
        }

        .grayCard {
            background-color: #f1f1f1;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .grayCard::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 150px;
            height: 150px;
            background: var(--secondary-color);
            opacity: 0.05;
            border-radius: 50%;
        }

        .grayCard:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .whiteCard {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }

        .whiteCard::after {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            background: var(--primary-color);
            opacity: 0.1;
            border-radius: 50%;
        }

        .packages {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            padding: 60px 0;
        }

        .package {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .package::before {
            content: '';
            position: absolute;
            top: -60px;
            left: -60px;
            width: 120px;
            height: 120px;
            background: var(--primary-color);
            opacity: 0.1;
            border-radius: 50%;
        }

        .package:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .package .packageFeatures ul {
            list-style: none;
            padding: 0;
        }

        .package .packageFeatures li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #555;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .package .packageFeatures li i {
            color: var(--primary-color);
            margin-right: 8px;
        }

        .PremiumPackage {
            background: linear-gradient(135deg, var(--secondary-color)0%, var(--primary-color) 100%);
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .PremiumPackage::after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .hero__wrapper {
                height: calc(100vh - 6.5rem);
            }

            .hero__wrapper:after,
            .hero__wrapper:before {
                width: 50%;
            }
        }

        .btn-generate-custom {
            background-color: var(--primary-color);
            color: #fff;
            border-radius: 50px;
            padding: 12px 30px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-generate-custom:hover {
            background-color: var(--secondary-color);
            color: #fff;
            transform: translateY(-5px);
        }

        .btn-generate {
            border: none;
            width: 12em;
            height: 4em;
            border-radius: 3em;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            background: #1C1A1C;
            cursor: pointer;
            transition: all 450ms ease-in-out;
        }

        .sparkle {
            fill: #AAAAAA;
            transition: all 800ms ease;
        }

        .text {
            font-weight: 600;
            color: #AAAAAA;
            font-size: medium;
        }

        .btn-generate:hover {
            background: linear-gradient(0deg, #A47CF3, var(--primary-color));
            box-shadow: inset 0px 1px 0px 0px rgba(255, 255, 255, 0.4),
                inset 0px -4px 0px 0px rgba(0, 0, 0, 0.2),
                0px 0px 0px 4px rgba(255, 255, 255, 0.2),
                0px 0px 180px 0px #9917FF;
            transform: translateY(-2px);
        }

        .btn-generate:hover .text {
            color: white;
        }

        .btn-generate:hover .sparkle {
            fill: white;
            transform: scale(1.2);
        }

        .feature-card {
            border: 2px solid gray;
            border-radius: 14px;
            padding: 28px;
            background: #f3f5f6;
        }

        .feature-card:hover {
            border-color: var(--primary-color);
            background: #fff;
            transition: all 0.3s ease-in-out;
        }

        #typed-text,
        .text-section {
            border: 2px solid wheat;
            border-radius: 21px;
            padding: 5px 18px;
            display: inline-block;
        }

        .text-section {
            font-weight: 700;
        }
    </style>

    <?php if (auth()->guard()->guest()): ?>
        <div id="hero" class="hero section">
            <div class="hero__wrapper" data-aos="fade-up">
                <div class="hero__wrapper-txt">
                    <h1 class="title" data-aos="fade-down" data-aos-delay="200">
                        أنجز مشروعك مع محترفين،<br><span id="typed-text"></span>
                    </h1>
                    <p class="info" data-aos="fade-up" data-aos-delay="400">
                        أنشئ طلبك في دقائق، استلم عروضًا فورية، وادفع بأمان عند استلام النتائج.
                    </p>
                </div>

                <div class="hero__wrapper-btns" data-aos="zoom-in" data-aos-delay="600">
                    <a class="btn-generate" href="">
                        <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1"
                            class="sparkle">
                            <path
                                d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                            </path>
                        </svg>

                        <span class="text">ابدأ الآن</span>
                    </a>
                </div>

            </div>
        </div>
    <?php endif; ?>

    <style>
        .timeline {
            position: relative;
            width: 100%;
            max-width: 1140px;
            margin: 0 auto;
            padding: 15px 0;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 2px;
            background: #006E51;
            top: 0;
            bottom: 0;
            right: 50%;
            margin-right: -1px;
        }

        .container-timeline {
            padding: 15px 30px;
            position: relative;
            background: inherit;
            width: 50%;
        }

        .container-timeline.left {
            right: 0;
        }

        .container-timeline.right {
            right: 50%;
        }

        .container-timeline::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: calc(50% - 8px);
            left: -8px;
            background: #ffffff;
            border: 2px solid #006E51;
            border-radius: 16px;
            z-index: 1;
        }

        .container-timeline.right::after {
            right: -8px;
        }

        .container-timeline::before {
            content: '';
            position: absolute;
            width: 50px;
            height: 2px;
            top: calc(50% - 1px);
            left: 8px;
            background: #006E51;
            z-index: 1;
        }

        .container-timeline.right::before {
            right: 8px;
        }

        .container-timeline .date {
            position: absolute;
            display: inline-block;
            top: calc(50% - 8px);
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            color: #006E51;
            text-transform: uppercase;
            letter-spacing: 1px;
            z-index: 1;
        }

        .container-timeline.left .date {
            left: -75px;
        }

        .container-timeline.right .date {
            right: -75px;
        }

        .container-timeline .icon {
            position: absolute;
            display: inline-block;
            width: 40px;
            height: 40px;
            padding: 9px 0;
            top: calc(50% - 20px);
            background: #F6D155;
            border: 2px solid #006E51;
            border-radius: 40px;
            text-align: center;
            font-size: 18px;
            color: #006E51;
            z-index: 1;
        }

        .container-timeline.left .icon {
            left: 56px;
        }

        .container-timeline.right .icon {
            right: 56px;
        }

        .container-timeline .content {
            padding: 29px 44px 28px 26px;
            background: #F6D155;
            position: relative;
            border-radius: 0 500px 500px 0;
        }

        .container-timeline.right .content {
            padding: 30px 82px 30px 90px;
            border-radius: 500px 0 0 500px;
        }

        .container-timeline .content h2 {
            margin: 0 0 10px 0;
            font-size: 18px;
            font-weight: normal;
            color: #006E51;
        }

        .container-timeline .content p {
            margin: 0;
            font-size: 16px;
            line-height: 22px;
            color: #000000;
        }

        @media (max-width: 767.98px) {
            .timeline::after {
                right: 90px;
            }

            .container-timeline {
                width: 100%;
                padding-right: 120px;
                padding-left: 30px;
            }

            .container-timeline.right {
                right: 0%;
            }

            .container-timeline.left::after,
            .container-timeline.right::after {
                right: 82px;
            }

            .container-timeline.left::before,
            .container-timeline.right::before {
                right: 100px;
                border-color: transparent #006E51 transparent transparent;
            }

            .container-timeline.left .date,
            .container-timeline.right .date {
                left: auto;
                right: 15px;
            }

            .container-timeline.left .icon,
            .container-timeline.right .icon {
                left: auto;
                right: 146px;
            }

            .container-timeline.left .content,
            .container-timeline.right .content {
                padding: 30px 30px 30px 90px;
                border-radius: 500px 0 0 500px;
            }
        }
    </style>
    <!-- وصف عام أعلى الخط الزمني -->
    <h2 class="text-center text-3xl font-extrabold mb-8">كيف نعمل؟</h2>
    <p class="text-center text-gray-600 mb-14">
        عملية بسيطة من ستّ خطوات تضمن وضوح المطلوب، شفافية التكلفة، وإنجاز المشروع في الموعد.
    </p>

    <!-- الخط الزمني لإنشاء مشروع -->
    <div class="timeline">

        <!-- 1. وصف المشروع -->
        <div class="container-timeline left">
            <i class="icon fa fa-pencil-alt"></i>
            <div class="content">
                <h2>اكتب تفاصيل فكرتك</h2>
                <p>اشرح المطلوب، النتائج المتوقعة، وأي مراجع أو أمثلة تساعد المستقل.</p>
            </div>
        </div>

        <!-- 2. الميزانية والموعد -->
        <div class="container-timeline right">
            <i class="icon fa fa-dollar-sign"></i>
            <div class="content">
                <h2>حدّد الميزانية والمدة</h2>
                <p>اختر سعرًا ثابتًا أو بالساعة، وحدد موعد التسليم الذي يناسبك.</p>
            </div>
        </div>

        <!-- 3. استلام العروض -->
        <div class="container-timeline left">
            <i class="icon fa fa-comments"></i>
            <div class="content">
                <h2>استقبل العروض واطرح الأسئلة</h2>
                <p>راجع ملفات المستقلين، قيِّم خبراتهم، وتواصل عبر الدردشة لشرح أي تفاصيل إضافية.</p>
            </div>
        </div>

        <!-- 4. اختيار المستقل -->
        <div class="container-timeline right">
            <i class="icon fa fa-user-check"></i>
            <div class="content">
                <h2>اختر الأنسب وابدأ العمل</h2>
                <p>اعتمد العرض الأنسب، وقم بتمويل الدفعة الآمنة ليبدأ المستقل التنفيذ مباشرة.</p>
            </div>
        </div>

        <!-- 5. المتابعة والتتبع -->
        <div class="container-timeline left">
            <i class="icon fa fa-clock"></i>
            <div class="content">
                <h2>تابِع التقدّم لحظة بلحظة</h2>
                <p>شاهد لقطات الشاشة، تقارير الوقت، والتحديثات المرحلية للتأكد أنّ كل شيء يسير حسب الخطة.</p>
            </div>
        </div>

        <!-- 6. استلام المشروع والدفع -->
        <div class="container-timeline right">
            <i class="icon fa fa-flag-checkered"></i>
            <div class="content">
                <h2>استلم وقيِّم وانتهى الأمر</h2>
                <p>راجع العمل النهائي، أطلِق الدفع إذا كان كل شيء موافقًا للتوقعات، واترك تقييمك للمستقل.</p>
            </div>
        </div>

    </div>
    <!-- ① أضف المكتبتين قبل إغلاق </body> مباشرة -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <script>
        // ② شغّل الأنيميشن
        document.addEventListener('DOMContentLoaded', () => {
            gsap.registerPlugin(ScrollTrigger);

            // لكل عنصر .container-timeline
            gsap.utils.toArray('.container-timeline').forEach(item => {

                // لو العنصر يسار، ابدأ من اليمين والعكس صحيح
                const fromVars = item.classList.contains('left') ?
                    {
                        x: 100,
                        opacity: 0
                    } :
                    {
                        x: -100,
                        opacity: 0
                    };

                gsap.from(item, {
                    ...fromVars,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: item, // متى يبدأ
                        start: 'top 80%', // عندما يلمس 80% من الشاشة
                        toggleActions: 'play none none reverse'
                    }
                });
            });
        });
    </script>



    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">
        <div class="grid grid-cols-12 gap-6">


            <?php if (settings('appearance')->is_featured_categories && $categories && $categories->count()): ?>
                <div class="col-span-12 mt-6 xl:mt-6 mb-16">
                    <span
                        class="font-semibold text-gray-400 dark:text-gray-200 uppercase tracking-wider text-center block"><?php echo e(__('messages.t_featured_categories'), false); ?></span>
                    <div class="flex-wrap justify-center items-center mt-8 -mx-5 hidden" id="featured-categories-slick"
                        wire:ignore>

                        <?php $__currentLoopData = $categories;
                        $__env->addLoop($__currentLoopData);
                        foreach ($__currentLoopData as $category): $__env->incrementLoopIndices();
                            $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(url('categories', $category->slug), false); ?>"
                                class="relative !h-72 rounded-md !p-6 !flex !flex-col overflow-hidden group mx-5">
                                <span aria-hidden="true" class="absolute inset-0">
                                    <img src="<?php echo e(placeholder_img(), false); ?>" data-src="<?php echo e(src($category->image), false); ?>"
                                        alt="<?php echo e($category->name, false); ?>" class="lazy w-full h-full object-center object-cover">
                                </span>
                                <span aria-hidden="true"
                                    class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black opacity-90"></span>
                                <span
                                    class="relative mt-auto text-center text-xl font-bold text-white"><?php echo e($category->name, false); ?></span>
                            </a>
                        <?php endforeach;
                        $__env->popLoop();
                        $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            <?php endif; ?>


            <?php if (settings('appearance')->is_best_sellers && $sellers && $sellers->count()): ?>
                <div class="col-span-12 mt-6 xl:mt-6 mb-16">
                    <span
                        class="font-semibold text-gray-400 dark:text-gray-200 uppercase tracking-wider text-center block"><?php echo e(__('messages.t_top_sellers'), false); ?></span>
                    <a href="<?php echo e(url('sellers'), false); ?>"
                        class="mt-1 text-primary-600 hover:text-primary-700 text-xs font-medium uppercase tracking-widest text-center block"><?php echo e(__('messages.t_view_more'), false); ?></a>

                    <ul class="flex-wrap justify-center items-center mt-8 -mx-5 hidden" id="top-sellers-slick" wire:ignore>
                        <?php $__currentLoopData = $sellers;
                        $__env->addLoop($__currentLoopData);
                        foreach ($__currentLoopData as $seller): $__env->incrementLoopIndices();
                            $loop = $__env->getLastLoop(); ?>
                            <li
                                class="col-span-1 flex flex-col text-center bg-white dark:bg-zinc-800 rounded-md shadow divide-y divide-gray-200 dark:divide-zinc-700 mx-5">
                                <div class="px-4 py-8">


                                    <a href="<?php echo e(url('profile', $seller->username), false); ?>" target="_blank"
                                        class="inline-block relative">
                                        <img class="h-16 w-16 rounded-full object-cover lazy" src="<?php echo e(placeholder_img(), false); ?>"
                                            data-src="<?php echo e(src($seller->avatar), false); ?>" alt="<?php echo e($seller->username, false); ?>">
                                        <?php if ($seller->isOnline() && !$seller->availability): ?>
                                            <span
                                                class="absolute top-0.5 ltr:right-0.5 rtl:left-0.5 block h-3 w-3 rounded-full ring-2 ring-white dark:ring-zinc-800 bg-green-400"></span>
                                        <?php elseif ($seller->availability): ?>
                                            <span
                                                class="absolute top-0.5 ltr:right-0.5 rtl:left-0.5 block h-3 w-3 rounded-full ring-2 ring-white dark:ring-zinc-800 bg-gray-400"></span>
                                        <?php else: ?>
                                            <span
                                                class="absolute top-0.5 ltr:right-0.5 rtl:left-0.5 block h-3 w-3 rounded-full ring-2 ring-white dark:ring-zinc-800 bg-red-400"></span>
                                        <?php endif; ?>
                                    </a>


                                    <a href="<?php echo e(url('profile', $seller->username), false); ?>" target="_blank"
                                        class="mt-4 text-gray-900 dark:text-gray-200 text-sm font-bold tracking-wider flex items-center justify-center">
                                        <?php echo e($seller->username, false); ?>

                                        <?php if ($seller->status === 'verified'): ?>
                                            <img data-tooltip-target="tooltip-account-verified-<?php echo e($seller->id, false); ?>"
                                                class="ltr:ml-0.5 rtl:mr-0.5 h-4 w-4 -mt-0.5"
                                                src="<?php echo e(url('public/img/auth/verified-badge.svg'), false); ?>"
                                                alt="<?php echo e(__('messages.t_account_verified'), false); ?>">
                                            <div id="tooltip-account-verified-<?php echo e($seller->id, false); ?>" role="tooltip"
                                                class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                <?php echo e(__('messages.t_account_verified'), false); ?>

                                            </div>
                                        <?php endif; ?>
                                    </a>

                                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                                        <dt class="sr-only">Level</dt>
                                        <dd class="text-[11px] font-medium uppercase tracking-widest"
                                            style="color:<?php echo e($seller->level->level_color, false); ?>"><?php echo e($seller->level->title, false); ?></dd>
                                        <dt class="sr-only">Skills</dt>
                                        <dd class="mt-5 space-x-1 rtl:space-x-reverse">


                                            <div class="flex items-center justify-center mb-5" wire:ignore>


                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>


                                                <?php if ($seller->rating() == 0): ?>
                                                    <div
                                                        class=" text-[13px] tracking-widest text-amber-500 ltr:ml-1 rtl:mr-1 font-black">
                                                        <?php echo e(__('messages.t_n_a'), false); ?></div>
                                                <?php else: ?>
                                                    <div
                                                        class=" text-sm tracking-widest text-amber-500 ltr:ml-1 rtl:mr-1 font-black">
                                                        <?php echo e($seller->rating(), false); ?></div>
                                                <?php endif; ?>


                                                <div
                                                    class="ltr:ml-2 rtl:mr-2 text-[13px] font-normal text-gray-400 dark:text-gray-300">
                                                    ( <?php echo e(number_format($seller->reviews()->count()), false); ?> )
                                                </div>

                                            </div>


                                            <?php if ($seller->skills()->count()): ?>
                                                <div class="h-16">
                                                    <?php $__currentLoopData = $seller->skills()->InRandomOrder()->limit(3)->get();
                                                    $__env->addLoop($__currentLoopData);
                                                    foreach ($__currentLoopData as $skill): $__env->incrementLoopIndices();
                                                        $loop = $__env->getLastLoop(); ?>
                                                        <span
                                                            class="inline-flex mb-2 px-3 py-1.5 items-center text-gray-800 text-xs font-medium bg-gray-100 dark:bg-zinc-700 dark:text-zinc-300 rounded-full">
                                                            <?php echo e($skill->name, false); ?>

                                                        </span>
                                                    <?php endforeach;
                                                    $__env->popLoop();
                                                    $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="h-16"></div>
                                            <?php endif; ?>

                                        </dd>
                                    </dl>

                                </div>


                                <div>
                                    <div
                                        class="-mt-px flex divide-x divide-gray-200 rtl:divide-x-reverse bg-gray-100 dark:bg-zinc-700 dark:divide-zinc-700 rounded-b-lg">

                                        <?php if (auth()->guard()->check()): ?>

                                            <div class="w-0 flex-1 flex">
                                                <a href="<?php echo e(url('messages/new', $seller->username), false); ?>"
                                                    class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-xs text-gray-700 dark:text-zinc-300 dark:hover:text-zinc-100 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-300"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                    </svg>
                                                    <span class="ml-2"><?php echo e(__('messages.t_contact_me'), false); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (auth()->guard()->guest()): ?>

                                            <div class="w-0 flex-1 flex">
                                                <a href="<?php echo e(url('profile', $seller->username), false); ?>"
                                                    class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-xs text-gray-700 dark:text-zinc-300 dark:hover:text-zinc-100 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5 text-gray-400 dark:text-gray-300" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="ml-2"><?php echo e(__('messages.t_view_profile'), false); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>

                            </li>
                        <?php endforeach;
                        $__env->popLoop();
                        $loop = $__env->getLastLoop(); ?>
                    </ul>

                </div>
            <?php endif; ?>


            <?php if (settings('projects')->is_enabled && !is_null($projects) && !$projects->isEmpty()): ?>
                <div class="col-span-12 mb-16">


                    <div class="block mb-6">
                        <div class="flex justify-between items-center bg-transparent py-2">

                            <div>
                                <span
                                    class="font-extrabold text-xl text-gray-800 dark:text-gray-100 pb-1 block tracking-wider">
                                    <?php echo app('translator')->get('messages.t_featured_projects'); ?>
                                </span>
                            </div>

                            <div>
                                <a href="<?php echo e(url('explore/projects'), false); ?>"
                                    class="hidden text-sm font-semibold text-primary-600 hover:text-primary-700 sm:block">
                                    <?php echo e(__('messages.t_view_more'), false); ?>



                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden ltr:inline" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>


                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden rtl:inline" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                    </svg>
                                </a>
                            </div>

                        </div>
                    </div>


                    <div class="space-y-6">
                        <?php $__currentLoopData = $projects;
                        $__env->addLoop($__currentLoopData);
                        foreach ($__currentLoopData as $project): $__env->incrementLoopIndices();
                            $loop = $__env->getLastLoop(); ?>

                            <?php
                            $__split = function ($name, $params = []) {
                                return [$name, $params];
                            };
                            [$__name, $__params] = $__split('main.cards.project', ['id' => $project->uid]);

                            $__html = app('livewire')->mount($__name, $__params, 'project-card-id-' . $project->uid, $__slots ?? [], get_defined_vars());

                            echo $__html;

                            unset($__html);
                            unset($__name);
                            unset($__params);
                            unset($__split);
                            if (isset($__slots)) unset($__slots);
                            ?>

                        <?php endforeach;
                        $__env->popLoop();
                        $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
            <?php endif; ?>


            <?php if (settings('newsletter')->is_enabled): ?>
                <div class="col-span-12">
                    <div class="bg-gray-100 dark:bg-zinc-800 rounded-md p-6 flex items-center sm:p-10">
                        <div class="max-w-lg mx-auto">
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100">
                                <?php echo e(__('messages.t_sign_up_for_newsletter'), false); ?></h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                                <?php echo e(__('messages.t_sign_up_for_newsletter_subtitle'), false); ?></p>
                            <div class="mt-4 sm:mt-6 sm:flex">
                                <label for="email-address" class="sr-only">Email address</label>
                                <input wire:model.defer="email" id="email-address" type="text" autocomplete="email"
                                    required="" placeholder="<?php echo e(__('messages.t_enter_email_address'), false); ?>"
                                    class="h-14 appearance-none min-w-0 w-full bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-700 rounded-md shadow-sm py-2 px-4 text-sm text-gray-900 dark:text-gray-300 placeholder-gray-500 focus:outline-none focus:border-primary-600 focus:ring-1 focus:ring-primary-600"
                                    readonly onfocus="this.removeAttribute('readonly');">
                                <div class="mt-3 sm:flex-shrink-0 sm:mt-0 ltr:sm:ml-4 rtl:sm:mr-4">
                                    <button wire:click="newsletter" wire:loading.attr="disabled" wire:target="newsletter"
                                        type="button"
                                        class="dark:disabled:bg-zinc-500 dark:disabled:text-zinc-400 disabled:cursor-not-allowed disabled:!bg-gray-400 disabled:text-gray-500 h-14 w-full bg-primary-600 border border-transparent rounded-md shadow-sm py-2 px-4 flex items-center justify-center text-sm font-bold tracking-wider text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary-600">
                                        <?php echo e(__('messages.t_signup'), false); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>

<?php $__env->startPush('scripts'); ?>


<?php if (settings('appearance')->is_featured_categories || settings('appearance')->is_best_sellers): ?>
    <script defer type="text/javascript" src="<?php echo e(asset('js/plugins/slick/slick.min.js'), false); ?>"></script>
<?php endif; ?>


<?php if (settings('appearance')->is_featured_categories && $categories && $categories->count()): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Init featured categories slick
            $('#featured-categories-slick').slick({
                dots: false,
                autoplay: true,
                infinite: true,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,
                arrows: false,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            $('#featured-categories-slick').removeClass('hidden');
        });
    </script>
<?php endif; ?>


<?php if (settings('appearance')->is_best_sellers && $sellers && $sellers->count()): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Init featured categories slick
            $('#top-sellers-slick').slick({
                dots: false,
                autoplay: true,
                infinite: true,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,
                arrows: false,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            $('#top-sellers-slick').removeClass('hidden');
        });
    </script>
<?php endif; ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>


<?php if (settings('appearance')->is_featured_categories || settings('appearance')->is_best_sellers): ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/plugins/slick/slick.css'), false); ?>" />
<?php endif; ?>


<style>
    .home-hero-section {
        background-color:
            <?php echo e(settings('hero')->bg_color, false); ?>;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        height:
            <?php echo e(settings('hero')->bg_large_height, false); ?> px;
    }

        {
            {
            -- Check if background image enabled --
        }
    }

    <?php if (settings('hero')->enable_bg_img): ?> {
            {
            -- Background image for small devices --
        }
    }

    <?php if (settings('hero')->background_small): ?>@media only screen and (max-width: 600px) {
        .home-hero-section {
            background-image: url('<?php echo e(src(settings('hero')->background_small), false); ?>');
            height:
                <?php echo e(settings('hero')->bg_small_height, false); ?> px;
        }
    }

    <?php endif; ?> {
            {
            -- Background image for medium devices --
        }
    }

    <?php if (settings('hero')->background_medium): ?>@media only screen and (min-width: 600px) {
        .home-hero-section {
            background-image: url('<?php echo e(src(settings('hero')->background_medium), false); ?>')
        }
    }

    <?php endif; ?> {
            {
            -- Background image for large devices --
        }
    }

    <?php if (settings('hero')->background_large): ?>@media only screen and (min-width: 768px) {
        .home-hero-section {
            background-image: url('<?php echo e(src(settings('hero')->background_large), false); ?>');
        }
    }

    <?php endif; ?> {
            {
            -- Background image for large devices --
        }
    }

    <?php if (settings('hero')->background_large): ?>@media only screen and (min-width: 992px) {
        .home-hero-section {
            background-image: url('<?php echo e(src(settings('hero')->background_large), false); ?>');
        }
    }

    <?php endif; ?> {
            {
            -- Background image for large devices --
        }
    }

    <?php if (settings('hero')->background_large): ?>@media only screen and (min-width: 1200px) {
        .home-hero-section {
            background-image: url('<?php echo e(src(settings('hero')->background_large), false); ?>');
        }
    }

    <?php endif; ?><?php endif; ?>
</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function() {

        const options = {
                strings: ['ابنِ فكرتك.', 'صمّم علامتك.', 'أطلق مشروعك.'],
                typeSpeed: 90,
                backSpeed: 45,
                backDelay: 1500,
                loop: true,
                cursorChar: '|'
            },

            typed = new Typed("#typed-text", options);

        AOS.init({
            duration: 1000,
            once: true,
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/home/home.blade.php ENDPATH**/ ?>