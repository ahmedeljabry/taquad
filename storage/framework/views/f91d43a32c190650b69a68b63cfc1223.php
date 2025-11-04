<div class="w-full px-6 py-10 sm:px-10 lg:px-12">
    <div class="mx-auto w-full max-w-lg space-y-10">

        
        <div class="space-y-3 text-center">
            <span class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-4 py-1 text-[11px] font-semibold uppercase tracking-[0.35em] text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                <i class="ph ph-sparkle text-xs"></i>
                <?php echo e(__('messages.t_login'), false); ?>

            </span>
            <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white sm:text-3xl">
                <?php echo e(__('messages.t_welcome_back'), false); ?>

            </h2>
            <p class="mx-auto max-w-sm text-sm leading-6 text-slate-500 dark:text-zinc-300">
                <?php echo e(__('messages.t_pls_login_to_continue'), false); ?>

            </p>
            <a href="<?php echo e(url('/'), false); ?>" class="inline-flex items-center justify-center gap-2 text-xs font-semibold text-primary-600 transition hover:text-primary-700 dark:text-primary-300">
                <i class="ph ph-arrow-square-out text-xs"></i>
                <?php echo app('translator')->get('messages.t_back_to_homepage'); ?>
            </a>
        </div>

        
        <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-500/40 dark:bg-emerald-500/10 dark:text-emerald-200">
                <?php echo e(session()->get('success'), false); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <?php if(session()->has('error')): ?>
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 dark:border-rose-500/40 dark:bg-rose-500/10 dark:text-rose-200">
                <?php echo e(session()->get('error'), false); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        
        <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm shadow-slate-900/5 dark:border-zinc-700 dark:bg-zinc-900">
            <div class="absolute inset-0 opacity-10 blur-2xl" style="background: radial-gradient(circle at top, rgba(59,130,246,0.45), transparent 55%), radial-gradient(circle at bottom, rgba(16,185,129,0.45), transparent 55%);"></div>
            <div class="relative space-y-8 p-6 sm:p-8">

                <div class="space-y-2">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">
                        <?php echo e(__('messages.t_login'), false); ?>

                    </h3>
                    <p class="text-sm text-slate-500 dark:text-zinc-400">
                        <?php echo e(__('messages.t_login_subtitle_modern', ['app' => config('app.name')]), false); ?>

                    </p>
                </div>

                <form x-data="window.zyKtAkZuKbBmbfC" x-on:submit.prevent="login" class="space-y-5">

                    
                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-400 dark:text-zinc-500">
                            <?php echo app('translator')->get('messages.t_email'); ?>
                        </label>
                        <div class="relative">
                            <input type="email" x-model="form.email"
                                class="w-full rounded-2xl border <?php echo e($errors->first('email') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-500/20' : 'border-slate-200 focus:border-primary-500 focus:ring-primary-500/10 dark:border-zinc-700 dark:focus:border-primary-400', false); ?> bg-white/80 px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 dark:bg-zinc-900/80 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                                placeholder="<?php echo e(__('messages.t_enter_email_address'), false); ?>">
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 dark:text-zinc-500">
                                <i class="ph ph-at text-lg"></i>
                            </span>
                        </div>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] font-semibold text-rose-500">
                                <?php echo e($errors->first('email'), false); ?>

                            </p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    
                    <div class="space-y-2" x-data="{ reveal: false }">
                        <label class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-400 dark:text-zinc-500">
                            <?php echo app('translator')->get('messages.t_password'); ?>
                        </label>
                        <div class="relative">
                            <input :type="reveal ? 'text' : 'password'" x-model="form.password"
                                class="w-full rounded-2xl border <?php echo e($errors->first('password') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-500/20' : 'border-slate-200 focus:border-primary-500 focus:ring-primary-500/10 dark:border-zinc-700 dark:focus:border-primary-400', false); ?> bg-white/80 px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 dark:bg-zinc-900/80 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                                placeholder="<?php echo e(__('messages.t_enter_password'), false); ?>">
                            <button type="button" x-on:click="reveal = !reveal"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 transition hover:text-slate-600 dark:text-zinc-500 dark:hover:text-zinc-300">
                                <i :class="reveal ? 'ph-eye-slash' : 'ph-eye'" class="ph text-lg"></i>
                            </button>
                        </div>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] font-semibold text-rose-500">
                                <?php echo e($errors->first('password'), false); ?>

                            </p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    
                    <div class="flex flex-wrap items-center justify-between gap-3 text-xs font-semibold">
                        <label class="inline-flex items-center gap-3 text-slate-500 dark:text-zinc-400">
                            <input id="remember-me" wire:model.defer="remember_me" type="checkbox"
                                class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                            <?php echo e(__('messages.t_remember_me'), false); ?>

                        </label>
                        <a href="<?php echo e(url('auth/password/reset'), false); ?>"
                            class="inline-flex items-center gap-1 text-primary-600 transition hover:text-primary-700 dark:text-primary-300">
                            <i class="ph ph-arrow-bend-up-left text-xs"></i>
                            <?php echo app('translator')->get('messages.t_forgot_password'); ?>
                        </a>
                    </div>

                    
                    <button type="submit" wire:loading.attr="disabled" wire:target="login"
                        :disabled="!form.email || !form.password"
                        class="group inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-primary-600 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-primary-500/30 transition hover:-translate-y-0.5 hover:bg-primary-700 disabled:cursor-not-allowed disabled:bg-slate-200 disabled:text-slate-500 dark:disabled:bg-zinc-600 dark:disabled:text-zinc-300">
                        <div wire:loading wire:target="login" class="flex items-center gap-2 text-xs uppercase tracking-[0.35em] text-primary-100">
                            <svg role="status" class="h-4 w-4 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="white" />
                            </svg>
                            <?php echo e(__('messages.t_please_wait_dots'), false); ?>

                        </div>
                        <span wire:loading.remove wire:target="login" class="text-xs uppercase tracking-[0.35em]">
                            <?php echo app('translator')->get('messages.t_login'); ?>
                        </span>
                    </button>
                </form>

                
                <div class="relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <span class="w-full border-t border-dashed border-slate-200 dark:border-zinc-700"></span>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="rounded-full bg-white px-3 text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-400 dark:bg-zinc-900 dark:text-zinc-500">
                            <?php echo e(__('messages.t_or'), false); ?>

                        </span>
                    </div>
                </div>

                
                <!--[if BLOCK]><![endif]--><?php if($social_grid): ?>
                    <div class="grid grid-cols-<?php echo e($social_grid > 3 ? 3 : $social_grid, false); ?> gap-3">
                        
                        <!--[if BLOCK]><![endif]--><?php if(settings('auth')->is_facebook_login): ?>
                            <a href="<?php echo e(url('auth/facebook'), false); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white/90 px-3 py-2 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-100">
                                <i class="ph ph-facebook-logo text-lg text-[#1877F2]"></i>
                                <span class="hidden sm:inline"><?php echo e(__('messages.t_continue_with_facebook'), false); ?></span>
                            </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        
                        <?php if(settings('auth')->is_google_login): ?>
                            <a href="<?php echo e(url('auth/google'), false); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white/90 px-3 py-2 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-100">
                                <i class="ph ph-google-logo text-lg text-[#EA4335]"></i>
                                <span class="hidden sm:inline"><?php echo e(__('messages.t_continue_with_google'), false); ?></span>
                            </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        
                        <?php if(settings('auth')->is_github_login): ?>
                            <a href="<?php echo e(url('auth/github'), false); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white/90 px-3 py-2 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-100">
                                <i class="ph ph-github-logo text-lg"></i>
                                <span class="hidden sm:inline"><?php echo e(__('messages.t_continue_with_github'), false); ?></span>
                            </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        
                        <?php if(settings('auth')->is_twitter_login): ?>
                            <a href="<?php echo e(url('auth/twitter'), false); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white/90 px-3 py-2 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-100">
                                <i class="ph ph-twitter-logo text-lg text-[#1DA1F2]"></i>
                                <span class="hidden sm:inline"><?php echo e(__('messages.t_continue_with_twitter'), false); ?></span>
                            </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        
                        <?php if(settings('auth')->is_linkedin_login): ?>
                            <a href="<?php echo e(url('auth/linkedin'), false); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white/90 px-3 py-2 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-100">
                                <i class="ph ph-linkedin-logo text-lg text-[#0A66C2]"></i>
                                <span class="hidden sm:inline"><?php echo e(__('messages.t_continue_with_linkedin'), false); ?></span>
                            </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                
                <div class="space-y-2 rounded-2xl bg-slate-100/70 p-4 text-[12px] font-semibold text-slate-500 dark:bg-zinc-800/70 dark:text-zinc-300">
                    <a class="flex items-center justify-between transition hover:text-primary-600 dark:hover:text-primary-300" href="<?php echo e(url('auth/register'), false); ?>">
                        <span><?php echo app('translator')->get('messages.t_create_account'); ?></span>
                        <i class="ph ph-arrow-up-right text-xs"></i>
                    </a>
                    <a class="flex items-center justify-between transition hover:text-primary-600 dark:hover:text-primary-300" href="<?php echo e(url('auth/password/reset'), false); ?>">
                        <span><?php echo app('translator')->get('messages.t_forgot_password'); ?></span>
                        <i class="ph ph-arrow-up-right text-xs"></i>
                    </a>
                    <a class="flex items-center justify-between transition hover:text-primary-600 dark:hover:text-primary-300" href="<?php echo e(url('auth/request'), false); ?>">
                        <span><?php echo app('translator')->get('messages.t_resend_verification_email'); ?></span>
                        <i class="ph ph-arrow-up-right text-xs"></i>
                    </a>

                    <!--[if BLOCK]><![endif]--><?php if(settings('footer')->privacy && settings('footer')->terms): ?>
                        <a class="flex items-center justify-between transition hover:text-primary-600 dark:hover:text-primary-300" href="<?php echo e(url('page', settings('footer')->privacy->slug), false); ?>">
                            <span><?php echo e(settings('footer')->privacy->title, false); ?></span>
                            <i class="ph ph-arrow-up-right text-xs"></i>
                        </a>
                        <a class="flex items-center justify-between transition hover:text-primary-600 dark:hover:text-primary-300" href="<?php echo e(url('page', settings('footer')->terms->slug), false); ?>">
                            <span><?php echo e(settings('footer')->terms->title, false); ?></span>
                            <i class="ph ph-arrow-up-right text-xs"></i>
                        </a>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>
        </div>

    </div>
</div>

<?php $__env->startPush('styles'); ?>
    <!--[if BLOCK]><![endif]--><?php if(settings('security')->is_recaptcha): ?>
        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(config('recaptcha.site_key'), false); ?>"></script>
        <script>
            var recaptcha_token = null;
            grecaptcha.ready(function () {
                grecaptcha.execute("<?php echo e(config('recaptcha.site_key'), false); ?>", { action: 'register' })
                        .then(function (token) {
                            var recaptcha_token = token;
                        });
            });
        </script>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function zyKtAkZuKbBmbfC() {
            return {

                recaptcha: Boolean("<?php echo e(settings('security')->is_recaptcha ? true : false, false); ?>"),

                form: {
                    email   : null,
                    password: null
                },

                login() {
                    var _this = this;

                    if (!_this.form.email || !_this.form.password) {
                        window.$wireui.notify({
                            title      : "<?php echo e(__('messages.t_error'), false); ?>",
                            description: "<?php echo e(__('messages.t_pls_check_ur_inputs_and_try_again'), false); ?>",
                            icon       : 'error'
                        });
                        return;
                    }

                    window.Livewire.find('<?php echo e($_instance->getId(), false); ?>').login({
                        'email'          : _this.form.email,
                        'password'       : _this.form.password,
                        'recaptcha_token': typeof recaptcha_token !== 'undefined' ? recaptcha_token : null
                    });
                }

            }
        }
        window.zyKtAkZuKbBmbfC = zyKtAkZuKbBmbfC();
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/auth/login.blade.php ENDPATH**/ ?>